<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::latest()->with(['user'])->get();
        
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post = $post->load('user', 'comments');
  
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        try {
            $this->validate(request(), [
                'title' => 'required',
                'body' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => $e->errors()
            ]);
        }
        
        $post->update([
            'title' => $request['title'],
            'body'  => $request['body']
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate(request(), [
                'title' => 'required',
                'body' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => $e->errors()
            ]);
        }
        
        Post::create([
            'user_id' => auth()->user()->id,
            'title'   => $request['title'],
            'body'    => $request['body']
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
