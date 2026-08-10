<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   
    public function create()
    {
        return view('contact.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $validated['title'] = strip_tags($validated['title']);
        $validated['body'] = strip_tags($validated['body']);

        Auth::user()->posts()->create($validated);

        return redirect()->route('contact.index')->with('success', 'Your query has been sent! We will get back to you soon.');
    }

    
    public function index()
    {
        $queries = Auth::user()->posts()->latest()->get();
        return view('contact.index', compact('queries'));
    }
}