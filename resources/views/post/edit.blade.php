@extends('layouts.main')

@section('title', 'Editing post')

@section('content')

    <style>
        .input-field {
            width: 50%; /* Adjust the width as desired */
        }
    </style>
    <a href="{{route('posts.index')}}">Cancel</a>
    @if (session()->has('message'))
        <p style="color: green;"><b>{{ session('message') }}</b></p>
    @endif
    <h2>Existing images</h2>
    @foreach($post->images as $image)
        <p>{{$image->url}}</p>
        <img src="{{ asset($image->url) }}" alt="Can't load image: {{$image->url}}" width=300></br>
        <form method="POST" action="{{route('images.destroy', ['id'=>$image->id])}}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete image</button>
        </form>
    @endforeach
    </br>
    <form method="POST" action="{{route('posts.update', ['id'=>$post->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="title">Title:</label></br></br>
    <input type="text" class="input-field" id="title" name="title" value="{{$post->title}}"></br></br>

    <label for="content">Content:</label></br></br>
    <textarea id="content" name="content" style="width: 50%; height: 300px;">{{$post->content}}</textarea></br></br>

    <h2>Upload more images</h2>
    <label for="image1">Image upload jpg,png,gif (optional)</label></br></br>
    <input type="file" class="input-field" name="image"></br></br>

    <label for="image1">Image 1 URL (optional):</label></br></br>
    <input type="text" class="input-field" id="image1" name="image1" value=""></br></br>

    <label for="image2">Image 2 URL (optional):</label></br>
    <input type="text" class="input-field" id="image2" name="image2" value=""></br></br>

    <label for="image3">Image 3 URL (optional):</label></br></br>
    <input type="text" class="input-field" id="image3" name="image3" value=""></br></br>

    <input type="submit" value="Save changes"></br></br>
    </form>
    
@endsection