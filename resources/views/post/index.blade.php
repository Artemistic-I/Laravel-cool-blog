@extends('layouts.main')

@section('title', 'Post timeline')

@section('content')
    <h3>All posts</h3>
        @foreach($posts as $post)
            Title: <a href="{{route('posts.show', ['id' => $post->id])}}">{{$post->title}}</a></br>
            <p>
                Posted by: {{$post->user->name}}
            </p>

            @foreach($post->images as $image)
                <img src="{{$image->url}}" alt="Can't load image: {{$image->url}}">
            @endforeach
            <ul>
                <li>Views: {{$post->views_count}}</li>
                <li>Likes: {{$post->likes_count}}</li>
                <li>Dislikes: {{$post->dislikes_count}}</li>
            </ul>

        @endforeach
@endsection