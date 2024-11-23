<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-post')->only(['index']);
        $this->middleware('permission:create-post')->only(['create', 'store']);
        $this->middleware('permission:edit-post')->only(['edit', 'update']);
        $this->middleware('permission:delete-post')->only(['destroy']);
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post başarıyla oluşturuldu.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post başarıyla güncellendi.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post başarıyla silindi.');
    }
}
