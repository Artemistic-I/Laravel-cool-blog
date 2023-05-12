<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
