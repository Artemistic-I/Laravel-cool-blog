@extends('layouts.main')

@section('title', 'Post timeline')

@section('content')
<a href="{{route('posts.create')}}">Create post</a>
<h2 style="color: orange;">Recent posts</h2>
@foreach($posts as $post)
Title: <a href="{{route('posts.show', ['id' => $post->id])}}">{{$post->title}}</a></br>
<p>
    Posted by: {{$post->user->name}}</br>
    Date: {{$post->created_at}}
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
{{$posts->links()}}
@endsection