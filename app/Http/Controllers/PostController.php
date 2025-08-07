<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Jobs\SendPostCreatedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class PostController extends Controller implements ShouldQueue
{
    public function index()
    {
        return view('posts.index', ['posts' => Post::latest()->get()]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->only('title', 'content'));

        // Email yuborishni queue'ga yuboramiz
        SendPostCreatedEmail::dispatch($post)->onQueue('sending-mails');

        return redirect()->route('posts.index')->with('success', 'Post yaratildi va email yuborilmoqda...');
    }
}
