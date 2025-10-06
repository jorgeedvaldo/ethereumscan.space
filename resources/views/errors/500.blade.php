@extends('template.app')
@section('title', 'Internal Server Error')
@section('style')
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #000;
            background-color: #fff;
        }

        nav {
            border-bottom: 1px solid #e5e5e5;
            padding: 1.5rem 0;
            margin-bottom: 3rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        nav a {
            text-decoration: none;
            color: #000;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #627EEA;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .error-container {
            text-align: center;
            padding: 4rem 0;
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #627EEA;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #000;
        }

        .error-message {
            font-size: 1.125rem;
            color: #666;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .btn-home {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: #627EEA;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #4c63d2;
        }

        .error-details {
            margin-top: 2rem;
            padding: 1rem;
            background-color: #f5f5f5;
            border-radius: 4px;
            font-size: 0.875rem;
            color: #666;
            max-width: 500px;
        }

        footer {
            border-top: 1px solid #e5e5e5;
            padding: 2rem 0;
            margin-top: 4rem;
            text-align: center;
            color: #666;
        }

        footer a {
            color: #627EEA;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
<div class="error-container">
    <div class="error-code">500</div>
    <h1 class="error-title">Internal Server Error</h1>
    <p class="error-message">
        Oops! Something went wrong on our server. We're working to fix the problem as quickly as possible.
    </p>
    <a href="/" class="btn-home">Back to Home</a>

    <div class="error-details">
        <strong>What you can do:</strong><br>
        • Try reloading the page in a few minutes<br>
        • Go back to the home page<br>
        • Contact us if the problem persists
    </div>
</div>
@endsection
