@extends('layouts.app')

@section('title', 'Post timeline')

@section('content')
    @auth
        </b><a href="{{route('posts.create')}}">Create post</a></br>
    @endauth

    @guest
        <p style="color: red;">You need to login/register to create a post</p>
    @endguest

    @if (session()->has('message'))
        <p style="color: green;"><b>{{ session('message') }}</b></p>
    @endif
    <h2 style="color: orange;">Recent posts</h2></b></b>
    @foreach($posts as $post)
        Title: <a href="{{route('posts.show', ['id' => $post->id])}}">{{$post->title}}</a></br>
        <p>
            Posted by: {{$post->user->name}}</br>
            Date: {{$post->created_at}}
        </p>

        @foreach($post->images as $image)
            <img src="{{ asset($image->url) }}" alt="Can't load image: {{$image->url}}" width=400>
        @endforeach
        <ul>
            <li>Views: {{$post->views_count}}</li>
            <li>Likes: {{$post->likes_count}}</li>
            <li>Dislikes: {{$post->dislikes_count}}</li>
        </ul></br></br>

    @endforeach
    {{$posts->links()}}
@endsection