@extends('layouts.main')

@section('title', 'Post timeline')

@section('content')
    </b><a href="{{route('posts.index')}}">Back to all posts</a></br></br>
    @auth
        <form method="POST" action="{{route('posts.destroy', ['id'=>$post->id])}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete post</button>
        </form></br>
        <form method="GET" action="{{route('posts.edit', ['id'=>$post->id])}}">
            @csrf
            <button type="submit">Edit post</button>
        </form>
    @endauth

    @guest
        <p style="color: red;">You need to login/register to edit or delete posts</p>
    @endguest
    <p>
        Post id = {{$post->id}}</br>
        Posted by {{$post->user->name}}</br>
        Date: {{$post->created_at}}</br></br>
        Title: {{$post->title ?? "unknown"}}</br></br>
        @foreach($post->images as $image)
            <img src="{{ asset($image->url) }}" alt="{{$image->url}}" width=400></br></br>
        @endforeach
        Content: {{$post->content ?? "unknown"}}</br>
        Likes: {{$post->likes_count ?? "unknown"}}</br>
        Dislikes: {{$post->dislikes_count ?? "unknown"}}</br>
        Views: {{$post->views_count ?? "unknown"}}</br>
    </p>
    <h3>Comments</h3>
    @auth
        <form method="POST" action="{{route('comments.store')}}">
            @csrf
            <textarea id="body" name="body" style="width: 50%; height: 50px;"></textarea></br>
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button type="submit">Publish comment</button>
        </form></br>
    @endauth

    @guest
        <p style="color: red;">You need to login/register to add a comment</p>
    @endguest

    @foreach($post->comments as $comment)
        @auth
            <p>
                User: {{$comment->user->name}}</br>
                {{$comment->body}}
            </p>
        @endauth

        @guest
            <p>
                User: {{$comment->user->name}}</br>
                {{$comment->body}}
            </p>
        @endguest
    @endforeach
@endsection