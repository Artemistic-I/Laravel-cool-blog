@extends('layouts.main')

@section('title', 'Post timeline')

@section('content')
    <p>
        Post id = {{$post->id}}</br>
        Posted by {{$post->user->name}}</br></br>
        Title: {{$post->title ?? "unknown"}}</br></br>
        @foreach($post->images as $image)
            <img src="{{$image->url}}" alt="{{$image->url}}"></br></br>
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