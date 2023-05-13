<div>
    @auth
    <input type="text" wire:model="content">
    <button wire:click="addComment">Add Comment</button></br></br>
    @endauth

    @guest
        <p style="color:red;">Login/register to add comments</p>
    @endguest
        @foreach ($commentsOnPost as $comment)
            <div>
                @auth
                    @if(auth()->id() == $comment->user_id)
                        @if ($comment->id === $editCommentId)
                            <input type="text" wire:model="editedComment" />
                            <button wire:click="updateComment({{ $comment->id }})">Save</button>
                        @else
                                <b>{{$comment->user->name}}</b>
                                <button wire:click="editComment({{ $comment->id }})">Edit</button>
                                <button wire:click="deleteComment({{ $comment->id }})">Delete</button></br>
                                {{$comment->body}}
                        @endif
                    @else
                        <b>{{$comment->user->name}}</b></br>
                        {{$comment->body}}
                    @endif
                @endauth

                @guest
                    <b>{{$comment->user->name}}</b></br>
                    {{$comment->body}}
                @endguest
            </div></br>
        @endforeach
</div>
