@extends('layouts.app')

@section('title', 'Create a new post')

@section('content')

    <style>
        .create-post-form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border-width: 1px;
            border-color: aqua;
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

        .create-post-form label {
            font-weight: bold;
        }

        .create-post-form input[type="submit"] {
            padding: 8px 16px;
            background-color: slateblue;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .create-post-form a {
            color: #4287f5;
            text-decoration: none;
        }
        .input-label {
            font-size: 18px;
            color: aqua;
        }
        .cancel-button {
            padding: 8px 16px;
            background-color: #4287f5;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 88%;
        }

    </style>
    <div class="create-post-form">
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <label class="input-label" for="title">Title:</label><br><br>
        <input type="text" class="input-field" id="title" name="title" value="{{ old('title') }}"><br><br>

        <label class="input-label" for="content">Content:</label><br><br>
        <textarea id="content" name="content" class="input-field" style="height: 300px;">{{ old('content') }}</textarea><br><br>

        <label class="input-label" for="image">Image Upload (optional):</label><br><br>
        <input type="file" class="input-field" id="image" name="image"><br><br>

        <label class="input-label" for="image1">Image 1 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image1" name="image1" value="{{ old('image1') }}"><br><br>

        <label class="input-label" for="image2">Image 2 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image2" name="image2" value="{{ old('image2') }}"><br><br>

        <label class="input-label" for="image3">Image 3 URL (optional):</label><br><br>
        <input type="text" class="input-field" id="image3" name="image3" value="{{ old('image3') }}"><br><br>

        <input type="submit" value="Create post"><br><br>
    </form>
    <a class="cancel-button" style="color:#ffffff;" href="{{ route('posts.index') }}">Cancel</a>
</div>

@endsection