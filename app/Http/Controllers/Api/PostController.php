<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Store a new post via API.
     */
    public function store(Request $request)
    {
        // ✅ Validate the request
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // ✅ Define a default image (e.g., stored in /public/images)
        $defaultImage = '/posts/images/default.jpg';

        // ✅ Create the post
        $post = Post::create([
            'title'   => $request->title,
            'slug' => 'my-slug', // Temporary slug; will be updated in the model's boot method
            'content' => $request->content,
            'status'  => $request->status,
            'user_id' => Auth::id(),
            'image'   => $defaultImage,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Post created successfully.',
            'data'    => $post,
        ], 201);
    }
}
