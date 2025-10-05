@extends('template.app')
@section('title', $post->title)
@section('meta_tags')
<!-- Meta Tags for SEO -->
<meta name="description" content="{{ $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 155) }}">
<meta name="keywords" content="{{ $post->meta_keywords ?? 'Bitcoin, BTC, Ethereum, ETH, DOGE, BNB, Crypto' }}">
<link rel="canonical" href="{{ route('blog.post', $post->slug) }}">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $post->title }} | {{ config('app.name', 'Ethereum Scan') }}">
<meta property="og:description" content="{{ $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 155) }}">
@if($post->image)
    <meta property="og:image" content="{{ asset('storage/' . $post->image) }}">
@endif
<meta property="og:url" content="{{ route('blog.post', $post->slug) }}">
<meta property="og:type" content="article">
<meta property="og:site_name" content="{{ config('app.name', 'Ethereum Scan') }}">
<meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}">
<meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->title }} | {{ config('app.name', 'Ethereum Scan') }}">
<meta name="twitter:description" content="{{ $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 155) }}">
@if($post->image)
    <meta name="twitter:image" content="{{ asset('storage/' . $post->image) }}">
@endif
@endsection
@section('style')
<style>
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #000;
            background: #fff;
        }

        nav {
            border-bottom: 1px solid #e5e5e5;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        nav a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #627EEA;
        }

        /*  Updated container to support two-column layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            gap: 3rem;
            align-items: flex-start;
        }

        .main-content {
            flex: 1;
            max-width: 800px;
        }
        /* </CHANGE> */

        h1 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .post-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .post-content {
            margin-bottom: 2rem;
        }

        .post-content p {
            margin-bottom: 1rem;
        }

        .img-fluid, .featured-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        a {
            color: #627EEA;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /*  Added sidebar styles for recent posts */
        .sidebar {
            width: 300px;
            flex-shrink: 0;
        }

        .sidebar h3 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #627EEA;
        }

        .recent-post {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e5e5;
        }

        .recent-post:last-child {
            border-bottom: none;
        }

        .recent-post h4 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .recent-post .date {
            color: #666;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
        /* </CHANGE> */

        footer {
            border-top: 1px solid #e5e5e5;
            margin-top: 4rem;
            padding: 2rem 0;
            text-align: center;
            color: #666;
        }
</style>
@endsection
@section('content')
<!-- Main content -->
<div class="main-content">
    <article>
        <h1>{{ $post->title }}</h1>
        <div class="post-meta">
            Published on {{ $post->created_at->translatedFormat('F d, Y') }}
            by <strong>{{ $post->user->name ?? 'Unknown Author' }}</strong>
        </div>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="featured-image">
        @endif

        <div class="post-content">
            {!! $post->content !!}
        </div>

        <a href="{{ url('/blog') }}">← Back to post list</a>
    </article>
</div>

<!-- Sidebar with recent posts -->
<aside class="sidebar">
    <h3>Recent Posts</h3>
    @foreach($recentPosts as $recent)
        <div class="recent-post">
            <h4>
                <a href="{{ route('blog.post', $recent->slug) }}">
                    {{ $recent->title }}
                </a>
            </h4>
            <div class="date">{{ $recent->created_at->translatedFormat('F d, Y') }}</div>
        </div>
    @endforeach
</aside>
@endsection
