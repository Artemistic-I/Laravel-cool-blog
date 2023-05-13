@extends('layouts.app')

@section('title', 'Editing post')

@section('content')

    <style>
        .post-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid aqua;
        }

        .input-field {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            max-width: 98%;
        }

        textarea.input-field {
            height: 200px;
            max-width: 98%;
        }

        .section-title {
            color: aqua;
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .cancel-link {
            padding: 8px 16px;
            background-color: #4287f5;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 88%;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .image-card {
            margin-bottom: 20px;
        }

        .image-card p {
            margin: 0;
            color: aqua;
            font-size: 16px;
        }

        .image-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .delete-image-button {
            padding: 8px 16px;
            background-color: #f54242;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-image-button:hover {
            background-color: #d30d0d;
        }

        .delete-image-button:active {
            background-color: #8f0b0b;
        }
        .submit-button {
            padding: 8px 16px;
            background-color: slateblue;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .mylabel {
            color:aqua;
        }
    </style>
   <div class="post-details">
    @if (session()->has('message'))
        <p class="success-message">{{ session('message') }}</p>
    @endif
    <b><h2 class="section-title">Existing images</h2></b>
    @foreach($post->images as $image)
        <div class="image-card">
            <p>Image URL:  <div style="color:white">{{$image->url}}</div></p></br>
            <img src="{{ asset($image->url) }}" alt="Can't load image: {{$image->url}}" width="300"><br>
            <form method="POST" action="{{ route('images.destroy', ['id'=>$image->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-image-button">Delete image</button>
            </form>
        </div>
    @endforeach
    <br>
    <form method="POST" action="{{ route('posts.update', ['id'=>$post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label class="mylabel" for="title">Title:</label><br><br>
        <input type="text" class="input-field" id="title" name="title" value="{{ $post->title }}"><br><br>

        <label class="mylabel" for="content">Content:</label><br><br>
        <textarea id="content" name="content" class="input-field" style="height: 300px;">{{ $post->content }}</textarea><br><br>

        <b><h2 class="section-title">Upload more images</h2></b>
        <label class="mylabel" for="image1">Image upload (optional):</label><br><br>
        <input type="file" class="input-field" name="image"><br><br>

        <label class="mylabel" for="image1">Image 1 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image1" name="image1" value=""><br><br>

        <label class="mylabel" for="image2">Image 2 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image2" name="image2" value=""><br><br>

        <label class="mylabel" for="image3">Image 3 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image3" name="image3" value=""><br><br>

        <input class="submit-button" type="submit" value="Save changes"><br><br>
    </form>
    <a class="cancel-link" href="{{ route('posts.index') }}">Cancel</a>
</div>

    
@endsection