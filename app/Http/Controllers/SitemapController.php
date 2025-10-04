<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::latest()->get();

        $content = view('sitemap.index', compact('posts'));

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
