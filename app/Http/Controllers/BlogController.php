<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('user')->firstOrFail();
        $recentPosts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return view('blog.post', compact('post', 'recentPosts'));
    }
}
