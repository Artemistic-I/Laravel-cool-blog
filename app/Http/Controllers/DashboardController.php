<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $posts = $user->posts;
        $comments = $user->comments;
        return view('dashboard', ['posts'=> $posts, 'comments'=> $comments]);
    }
}
