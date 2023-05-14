<div>
<style>
    .comment-title {
        color: aqua;
        font-size: 24px;
        text-align:center;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .mybutton {
        padding: 4px 12px;
        background-color:slateblue;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 10px;
    }
    .comment-card {
        border: 1px solid aqua;
        background-color:rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        padding: 5px;
        margin-bottom: 10px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .comment-text {
        margin-bottom:10px;
        margin-left:20px;
        margin-top: 5px;
        color:white;
    }
    .comment-author {
        padding-left: 20px;
        font-weight: bold;
        font-size: 18px;
        color:darkorange;
    }
</style>
    <h3 class="comment-title">Comments</h3>
    @auth
    <div style="text-align: center">
    <input class="form-control" style="width: 50%; margin-bottom: 20px; border-radius: 6px" type="text" wire:model="content">
    <button class="mybutton" wire:click="addComment">Add Comment</button>
    </div>
    @endauth

    @guest
        <p class="text-danger text-center">Login/register to add comments</p>
    @endguest
        @foreach ($commentsOnPost as $comment)
            <div class="comment-card">
                @auth
                    @if(auth()->id() == $comment->user_id || auth()->user()->roles->where('name','admin')->count() > 0)
                        @if ($comment->id === $editCommentId)
                            <input class="form-control" type="text" wire:model="editedComment" />
                            <button class="mybutton" wire:click="updateComment({{ $comment->id }})">Save</button>
                        @else
                            <button class="mybutton" wire:click="editComment({{ $comment->id }})">Edit</button>
                            <button class="mybutton" wire:click="deleteComment({{ $comment->id }})">Delete</button></br>
                            <span class="comment-author">{{$comment->user->name}}</span>
                            <p class="comment-text">{{$comment->body}}</p>
                        @endif
                    @else
                        <span class="comment-author">{{$comment->user->name}}</span>
                        <p class="comment-text">{{$comment->body}}</p>
                    @endif
                @endauth

                @guest
                    <span class="comment-author">{{$comment->user->name}}</span>
                    <p class="comment-text">{{$comment->body}}</p>
                @endguest
            </div>
        @endforeach
</div>

