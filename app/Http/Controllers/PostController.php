<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,update,task',
            'message' => 'required|string',
        ]);
        
        $validated['author'] = Auth::id();

        Post::create($validated);

        return redirect()->route('postdashboard')->with('success', 'Post created successfully.');
    }

    public function index()
    {
        $posts = Post::with('author:id,name,lastname')->latest()->get();

        return response()->json($posts);
    }

    public function update(Request $request, Post $post)
    {
        // Check if the authenticated user is the author of the post
        if (Auth::id() !== $post->author) {
            return redirect()->route('postdashboard')->with('error', 'Unauthorized action.');
        }
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,update,task',
            'message' => 'required|string',
        ]);
    
        $post->update($validated);
    
        return redirect()->route('postdashboard')->with('success', 'Post updated successfully.');
    }
    

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->id) {
            return redirect()->route('postdashboard')->with('error', 'Unauthorized action.');
        }
        
        $post->delete();

        return redirect()->route('postdashboard')->with('success', 'Post deleted successfully.');
    }
}
