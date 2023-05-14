<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\LikeOrCommentNotification;

class AddComment extends Component
{
    public $post_id;
    public $user_id;

    public $content;
    public $commentsOnPost;

    public $editCommentId;
    public $editedComment;

    public function mount($post_id, $user_id)
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->commentsOnPost = Comment::where('post_id', $this->post_id)->orderBy('created_at', 'desc')->get();
    }

    public function addComment()
    {
        $c = new Comment;
        $c->body = $this->content;
        $c->user_id = $this->user_id;
        $c->post_id = $this->post_id;
        $c->save();

        // Reset the name input
        $this->content = '';

        // Update the list of items
        $this->commentsOnPost = Comment::where('post_id', $this->post_id)->orderBy('created_at', 'desc')->get();

        //send email notification to the post author
        
        $post = Post::find($this->post_id);
        if (auth()->id() != $post->user->id) {
            $post_title = $post->title;
            $message = "Someone commented on your post: $post_title";
            $user = User::find($post->user->id);
            $notification = new LikeOrCommentNotification($message, $this->post_id);
            $user->notify($notification);
        }
    }

    public function editComment($commentId)
    {
        $this->editCommentId = $commentId;
        $this->editedComment = $this->commentsOnPost->firstWhere('id', $commentId)->body;
    }
    public function deleteComment($commentId)
    {
        $c = Comment::find($commentId);
        $c->delete();
        $this->commentsOnPost = Comment::where('post_id', $this->post_id)->orderBy('created_at', 'desc')->get();
    }

    public function updateComment($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->body = $this->editedComment;
        $comment->save();

        $this->editCommentId = null;
        $this->editedComment = '';
        $this->commentsOnPost = Comment::where('post_id', $this->post_id)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
