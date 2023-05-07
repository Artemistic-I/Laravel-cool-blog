@extends('layouts.main')

@section('title', 'Post timeline')

@section('content')
    <p>All posts</p>
        @foreach($posts as $post)
            <p>{{$post->title}}</p>

            @foreach($post->images as $image)
                <img src="{{$image->url}}" alt="some image">
            @endforeach

        @endforeach
@endsection