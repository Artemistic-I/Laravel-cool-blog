@extends('layouts.main')

@section('title', 'Create a new post')

@section('content')
    <!-- <script>
        // Your AJAX code here
    </script> -->
    <form method="POST" action="{{route('posts.store')}}">
    @csrf
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{old('title')}}"><br>
    <label for="content">Content:</label><br>
    <input type="text" id="content" name="content" value="{{old('content')}}"><br>

    <label for="image1">Image 1 URL:</label><br>
    <input type="text" id="image1" name="image1" value="{{old('image1')}}"><br>
    <label for="image2">Image 2 URL:</label><br>
    <input type="text" id="image2" name="image2" value="{{old('image2')}}"><br>
    <label for="image3">Image 3 URL:</label><br>
    <input type="text" id="image3" name="image3" value="{{old('image3')}}"><br>
    <input type="submit" value="Submit"><br>
    </form>
    <a href="{{route('posts.index')}}">Cancel</a>
@endsection