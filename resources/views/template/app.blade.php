<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <title>@yield('title') | {{env('APP_NAME')}}</title>
    @yield('meta_tags')
    @yield('style')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6Q32F4CW80"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-6Q32F4CW80');
    </script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#">Explore Blockchain</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Ethereum Scan. All rights reserved.</p>
    </footer>
</body>
</html>
