<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function index(): Response
    {
        $posts = Post::latest()->take(20)->get();

        $content = view('feed.rss', compact('posts'));

        return response($content, 200)
            ->header('Content-Type', 'application/rss+xml');
    }
}
