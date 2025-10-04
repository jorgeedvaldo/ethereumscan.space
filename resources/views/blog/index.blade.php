@extends('template.app')
@section('title', 'Blog')
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

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    h1 {
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .post {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e5e5e5;
    }

    .post h2 {
        margin-bottom: 0.5rem;
    }

    .post-meta {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    a {
        color: #627EEA;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /*  Added pagination styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin: 3rem 0;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border: 1px solid #e5e5e5;
        background: #fff;
        color: #000;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        border-color: #627EEA;
        color: #627EEA;
        text-decoration: none;
    }

    .pagination .active {
        background: #627EEA;
        color: #fff;
        border-color: #627EEA;
    }

    .pagination .disabled {
        opacity: 0.5;
        cursor: not-allowed;
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
<h1>Recent Posts</h1>

@foreach ($posts as $post)
<article class="post">
    <h2>
        <a href="{{ route('blog.post', $post->slug) }}">
            {{ $post->title }}
        </a>
    </h2>

    <div class="post-meta">
        Published on {{ $post->created_at->translatedFormat('F d, Y') }} by {{ $post->user->name }}
    </div>

    <p>{{ Str::limit(strip_tags($post->content), 150, '...') }}</p>
</article>
@endforeach

<div class="pagination">
    {{ $posts->links('template.pagination') }}
</div>
@endsection
