<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My posts') }}
        </h2>
    </x-slot>

    @section('title', 'My posts and comments')
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
            font-size: 25px;
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
    <h1 class="section-title">My posts</h1>

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
</div>
<div>
<style>
    .comment-title {
        color: aqua;
        font-size: 24px;
        text-align:center;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .mybutton {
        padding: 4px 12px;
        background-color:slateblue;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 43%;
    }
    .comment-card {
        border: 1px solid aqua;
        background-color:rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        padding: 5px;
        margin-bottom: 10px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .comment-text {
        margin-bottom:10px;
        margin-left:20px;
        margin-top: 5px;
        color:white;
    }
    .comment-author {
        padding-left: 20px;
        font-weight: bold;
        font-size: 18px;
        color:darkorange;
    }
</style>
    <h3 class="comment-title">My comments</h3>
    
        @foreach ($comments as $comment)
            <div class="comment-card">
                <h3 style="color:white; font-size: 16px; text-align:center; margin-bottom: 10px;">Post title:</h3>
                <h3 style="color:aqua; font-size: 16px; text-align:center; margin-bottom: 10px;">{{$comment->post->title}}</h3>
                <a class="mybutton" href="{{ route('posts.show', ['id' => $comment->post->id]) }}">Go to post</a></br>
                <span class="comment-author">{{$comment->user->name}}</span>
                <p class="comment-text">{{$comment->body}}</p>
            </div>
        @endforeach
</div>
    @endsection
</x-app-layout>
