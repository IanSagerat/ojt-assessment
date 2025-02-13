<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class PostDashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('author:id,name,lastname')->latest()->get();

        return Inertia::render('PostDashboard', [
            'auth' => [
                'user' => Auth::user()
            ],
            'posts' => $posts
        ]);
    }
}
