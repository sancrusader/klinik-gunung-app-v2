<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Menampilkan daftar artikel.
     */
    public function index()
    {
        $posts = Post::all();
        return view('pages.blog', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat artikel baru.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Menyimpan artikel baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',
            'author_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('author_profile_picture')) {
            $validated['author_profile_picture'] = $request->file('author_profile_picture')->store('author_profiles');
        }

        Post::create($validated);

        return redirect()->route('posts.index');
    }

    /**
     * Menampilkan detail artikel.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan form untuk mengedit artikel.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Memperbarui artikel yang ada di database.
     */
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',
            'author_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload foto profil jika ada
        if ($request->hasFile('author_profile_picture')) {
            // Hapus gambar lama jika ada
            if ($post->author_profile_picture) {
                Storage::delete($post->author_profile_picture);
            }

            // Simpan gambar baru
            $validated['author_profile_picture'] = $request->file('author_profile_picture')->store('author_profiles');
        }

        // Update artikel di database
        $post->update($validated);

        // Redirect ke halaman detail artikel
        return redirect()->route('posts.show', $post);
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy(Post $post)
    {
        // Hapus gambar profil jika ada
        if ($post->author_profile_picture) {
            Storage::delete($post->author_profile_picture);
        }

        // Hapus artikel dari database
        $post->delete();

        // Redirect ke halaman daftar artikel
        return redirect()->route('posts.index');
    }
}


