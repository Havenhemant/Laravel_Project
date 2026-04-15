<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   
    public function index()
    {
        $users = \App\Models\User::count();
        $posts = \App\Models\Post::count();

        return view('admin.dashboard', compact('users', 'posts'));
    }

   

    public function users()
    {
        return view('admin.users', [
            'users' => User::latest()->get()
        ]);
    }

    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user->update($request->only('username', 'email', 'role'));

        return redirect()->route('admin.users')->with('success', 'User updated');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }

    

    public function posts()
    {
        return view('admin.posts', [
            'posts' => Post::with('user')->latest()->get()
        ]);
    }

    public function editPost(Post $post)
    {
        return view('admin.edit-post', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post->update($request->only('title', 'body'));

        return redirect()->route('admin.posts')->with('success', 'Post updated');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted');
    }
}