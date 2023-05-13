@extends('layouts.app')

@section('title', 'Post timeline')

@section('content')
    <style>
        .post-card {
            max-width: 800px;
            border-width: 1px;
            border-color: aqua;
            margin: 0 auto;
            padding: 20px;
            background-color:rgba(0, 0, 0, 0.3);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .create-post-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4287f5;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .login-message {
            color: red;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .section-title {
            color:aqua;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
        }

        .post {
            padding: 16px;
            border: 1px solid aqua;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: white;
            
        }

        .post-title {
            margin-top: 0;
            margin-bottom: 10px;
            text-align: center;
            background-color:slateblue;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 8px 16px;
            display: inline-block;
        }

        .post-info {
            color: dodgerblue;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .post-images {
            margin-bottom: 10px;
        }

        .post-images img {
            display: block;
            margin-bottom: 10px;
            max-width: 100%;
            height: auto;
        }

        .post-stats {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .post-stats li {
            display: inline-block;
            margin-right: 10px;
            font-size: 14px;
            color:dodgerblue;
        }
    </style>
    <div class="post-card">
    <h1 class="section-title">Recent posts</h1>
    @auth
        <a class="create-post-link" href="{{ route('posts.create') }}">Create post</a><br>
    @endauth

    @guest
        <p class="login-message">You need to login/register to create a post</p>
    @endguest

    @if (session()->has('message'))
        <p class="success-message">{{ session('message') }}</p>
    @endif
    @foreach($posts as $post)
        <div class="post">
            <h3 class="post-title"><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
            <p class="post-info">
                Posted by: {{ $post->user->name }}<br>
                Date: {{ $post->created_at }}
            </p>

            <div class="post-images">
                @foreach($post->images as $image)
                    <img src="{{ asset($image->url) }}" alt="Can't load image: {{$image->url}}" width="500">
                @endforeach
            </div>
            <ul class="post-stats">
                <li>Views: {{ $post->views_count }}</li>
                <li>Likes: {{ $post->likes_count }}</li>
                <li>Dislikes: {{ $post->dislikes_count }}</li>
            </ul>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection