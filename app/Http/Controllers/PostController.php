<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $posts = Post::with('user')->latest()->paginate(6);

        if ($request->wantsJson()) {
            return response()->json($posts);
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $validated['title'] = strip_tags($validated['title']);
        $validated['body'] = strip_tags($validated['body']);

        Auth::user()->posts()->create($validated);

        return redirect()->back()->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update([
            'title' => strip_tags($validated['title']),
            'body' => strip_tags($validated['body']),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with('success', 'Post deleted!');
    }
}