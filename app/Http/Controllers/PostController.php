<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Menampilkan semua to-do list milik user yang sedang login.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('home', compact('posts'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'status' => 'In Progress',
        ]);

        return redirect()->route('home')->with('success', 'Todo Item Berhasil Ditambahkan');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:In Progress,Completed',
        ]);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit item ini.');
        }

        $post->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);
        return redirect()->route('home')->with('success', 'Todo Item Berhasil Diubah');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus item ini.');
        }

        $post->delete();
        return redirect()->route('home')->with('success', 'Todo Item Berhasil Dihapus');
    }
    public function toggleStatus(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah status item ini.');
        }

        // Toggle status antara In Progress dan Completed
        $post->status = $post->status === 'In Progress' ? 'Completed' : 'In Progress';
        $post->save();

        return redirect()->route('home')->with('success', 'Status berhasil diperbarui.');
    }
}
