<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    // Menampilkan semua topik
    public function index()
    {
        $topics = Topic::with('user')->latest()->get();
        return view('community.index', compact('topics'));
    }

    // Membuat topik baru
    public function storeTopic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('community.index')->with('success', 'Topik baru berhasil dibuat.');
    }

    // Menambahkan komentar ke topik
    public function storeComment(Request $request, $topicId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Comment::create([
            'body' => $request->body,
            'topic_id' => $topicId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('community.show', $topicId)->with('success', 'Komentar berhasil ditambahkan.');
    }

    // Menambahkan balasan ke komentar
    public function storeReply(Request $request, $commentId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Reply::create([
            'body' => $request->body,
            'comment_id' => $commentId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan.');
    }

    // Menampilkan detail topik beserta komentar dan balasan
    public function show($id)
    {
        $topic = Topic::with(['comments.replies', 'user'])->findOrFail($id);
        return view('community.show', compact('topic'));
    }
}
