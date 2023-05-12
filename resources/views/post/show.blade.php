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
    @foreach($post->comments as $comment)
        <p>
            User: {{$comment->user->name}}</br>
            {{$comment->body}}
        </p>
    @endforeach
@endsection