<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Notifications\LikeOrCommentNotification;

class PostInteractions extends Component
{
    public $post_id;
    public $user_id;
    public $post;
    public $likeButtonActive;
    public $dislikeButtonActive;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = auth()->id();
        $this->post = Post::find($post_id);
        $user = User::find(auth()->id());
        $isLikedPost = $user->interactedPosts()->where('status', 'like')->where('interaction_id', $this->post->id)->count() > 0;
        $isDislikedPost = $user->interactedPosts()->where('status', 'dislike')->where('interaction_id', $this->post->id)->count() > 0;

        $this->likeButtonActive = false;
        $this->dislikeButtonActive = false;
        if($isLikedPost) {
            $this->likeButtonActive = true;
        }
        if($isDislikedPost) {
            $this->dislikeButtonActive = true;
        }
    }
    public function like()
    {
        $user = User::find(auth()->id());
        $isLikedPost = $user->interactedPosts()->where('status', 'like')->where('interaction_id', $this->post->id)->count() > 0;
        $isDislikedPost = $user->interactedPosts()->where('status', 'dislike')->where('interaction_id', $this->post->id)->count() > 0;
        
        if($isLikedPost) {
            //remove like
            $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'view']);
            $this->likeButtonActive = false;

            $this->post->likes_count--;
            $this->post->save();
        } else {
            if($isDislikedPost) {
                //remove dislike and add like
                $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'like']);
                $this->dislikeButtonActive = false;
                $this->likeButtonActive = true;

                $this->post->dislikes_count--;
                $this->post->save();
                $this->post->likes_count++;
                $this->post->save();
            } else {
                //add a like
                $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'like']);
                $this->likeButtonActive = true;

                $this->post->likes_count++;
                $this->post->save();
            }
            //send email notification to the post author
            $post = Post::find($this->post_id);
            if (auth()->id() != $post->user->id) {
                $post_title = $post->title;
                $message = "Someone LIKED your post: $post_title";
                $user = User::find($post->user->id);
                $notification = new LikeOrCommentNotification($message, $this->post_id);
                $user->notify($notification);
            }
        }
        
        
    }
    public function dislike()
    {
        $user = User::find(auth()->id());
        $isLikedPost = $user->interactedPosts()->where('status', 'like')->where('interaction_id', $this->post->id)->count() > 0;
        $isDislikedPost = $user->interactedPosts()->where('status', 'dislike')->where('interaction_id', $this->post->id)->count() > 0;
        if($isDislikedPost) {
            //remove dislike
            $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'view']);
            $this->dislikeButtonActive = false;

            $this->post->dislikes_count--;
            $this->post->save();
        } else {
            if($isLikedPost) {
                //remove like and add dislike
                $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'dislike']);
                $this->likeButtonActive = false;
                $this->dislikeButtonActive = true;

                $this->post->likes_count--;
                $this->post->save();
                $this->post->dislikes_count++;
                $this->post->save();
            } else {
                //add a dislike
                $user->interactedPosts()->updateExistingPivot($this->post->id, ['status' => 'dislike']);
                $this->dislikeButtonActive = true;

                $this->post->dislikes_count++;
                $this->post->save();
            }
        }
        
    }

    public function render()
    {
        return view('livewire.post-interactions');
    }
}
