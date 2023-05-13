@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
    <style>
        .post-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color:white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .back-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4287f5;
            color: #fff;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .delete-form,
        .edit-form {
            display: inline-block;
            margin-right: 10px;
        }

        .delete-button {
            padding: 8px 16px;
            background-color: #f54242;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button {
            padding: 8px 16px;
            background-color:orange;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-message {
            color: red;
        }

        .post-info {
            margin-top: 20px;
            color: dodgerblue;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .post-title {
            color: black;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            font-size: 28px;
        }

        .post-images img {
            display: block;
            margin-bottom: 10px;
            max-width: 100%;
            height: auto;
        }

        .post-content {
            color: indigo;
            margin-bottom: 20px;
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
            color: #4287f5;
        }
    </style>
    <div class="post-details">
    <a class="back-link" href="{{ route('posts.index') }}">Back to all posts</a><br><br>
    @auth
        <form class="delete-form" method="POST" action="{{ route('posts.destroy', ['id'=>$post->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">Delete post</button>
        </form>
        <form class="edit-form" method="GET" action="{{ route('posts.edit', ['id'=>$post->id]) }}">
            @csrf
            <button type="submit" class="edit-button">Edit post</button>
        </form>
    @endauth

    @guest
        <p class="login-message">You need to login/register to edit or delete posts</p>
    @endguest
    <p class="post-info">
        Post id: {{ $post->id }}<br>
        Posted by: {{ $post->user->name }}<br>
        Date: {{ $post->created_at }}
    </p>
    <h2 class="post-title">{{ $post->title ?? 'Unknown' }}</h2>
    <div class="post-images">
        @foreach($post->images as $image)
            <img src="{{ asset($image->url) }}" alt="{{ $image->url }}" width="100%"><br><br>
        @endforeach
    </div>
    <p class="post-content">{{ $post->content ?? 'Unknown' }}</p>
    @auth
    <livewire:post-interactions :post_id="$post->id"/>
    @endauth
    @guest
    <ul class="post-stats">
        <li>Likes: {{ $post->likes_count ?? 'Unknown' }}</li>
        <li>Dislikes: {{ $post->dislikes_count ?? 'Unknown' }}</li>
        <li>Views: {{ $post->views_count ?? 'Unknown' }}</li>
    </ul>
    @endguest
</div>
    <livewire:add-comment :post_id="$post->id" :user_id="auth()->id()" /></br>
@endsection