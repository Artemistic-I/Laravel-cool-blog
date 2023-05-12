@extends('layouts.main')

@section('title', 'Create a new post')

@section('content')

    <style>
        .input-field {
            width: 50%; /* Adjust the width as desired */
        }
    </style>
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
    @csrf
    <label for="title">Title:</label></br></br>
    <input type="text" class="input-field" id="title" name="title" value="{{old('title')}}"></br></br>

    <label for="content">Content:</label></br></br>
    <textarea id="content" name="content" style="width: 50%; height: 300px;">{{old('content')}}</textarea></br></br>

    <label for="image1">Image upload jpg,png,gif (optional)</label></br></br>
    <input type="file" class="input-field" name="image"></br></br>

    <label for="image1">Image 1 URL (optional):</label></br></br>
    <input type="text" class="input-field" id="image1" name="image1" value="{{old('image1')}}"></br></br>

    <label for="image2">Image 2 URL (optional):</label></br>
    <input type="text" class="input-field" id="image2" name="image2" value="{{old('image2')}}"></br></br>

    <label for="image3">Image 3 URL (optional):</label></br></br>
    <input type="text" class="input-field" id="image3" name="image3" value="{{old('image3')}}"></br></br>

    <input type="submit" value="Create post"></br></br>
    </form>
    <a href="{{route('posts.index')}}">Cancel</a>
@endsection