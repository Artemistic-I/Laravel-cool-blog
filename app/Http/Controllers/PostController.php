<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,gif',
            'image1' => 'nullable',
            'image2' => 'nullable',
            'image3' => 'nullable',
        ]);
        $p = new Post;
        $p->title = $validatedData['title'];
        $p->content = $validatedData['content'];
        $p->likes_count = 0;
        $p->dislikes_count = 0;
        $p->views_count = 0;
        $p->user_id = auth()->id();
        $p->save();
        if ($validatedData['image1'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image1'];
            $i->save();
        }
        if ($validatedData['image2'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image2'];
            $i->save();
        }
    
        if ($validatedData['image3'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image3'];
            $i->save();
        }
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $filename = time() . '.' . $image->getClientOriginalExtension();

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('pictures'), $filename);

            $i = new Image;
            $i->post_id = $p->id;
            $i->url = 'pictures/' . $filename;
            $i->save();
            session()->flash('myurl', 'pictures/' . $filename);
        }
        session()->flash('message', 'Post was created');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', ['post'=>$post]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,gif',
            'image1' => 'nullable',
            'image2' => 'nullable',
            'image3' => 'nullable',
        ]);
        $p = $post = Post::findOrFail($id);
        $p->title = $validatedData['title'];
        $p->content = $validatedData['content'];
        $p->save();
        if ($validatedData['image1'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image1'];
            $i->save();
        }
        if ($validatedData['image2'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image2'];
            $i->save();
        }
    
        if ($validatedData['image3'] !== null) {
            $i = new Image;
            $i->post_id = $p->id;
            $i->url = $validatedData['image3'];
            $i->save();
        }
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $filename = time() . '.' . $image->getClientOriginalExtension();

            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('pictures'), $filename);

            $i = new Image;
            $i->post_id = $p->id;
            $i->url = 'pictures/' . $filename;
            $i->save();
            session()->flash('myurl', 'pictures/' . $filename);
        }
        session()->flash('message', 'Post has been updated');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $images = $post->images;
        foreach ($images as $image) {
            // Check if the url is a local path (doesn't start with 'http')
            if (!Str::startsWith($image->url, 'http')) {
                // Delete image file
                $imagePath = public_path($image->url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            // Delete image record
            $image->delete();
        }
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post was deleted');
    }
}
