<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Models\User;


class CommunityController extends Controller
{
    // Menampilkan semua topik
public function index()
{
    // Mengambil topik beserta user, comments, dan replies
    $topics = Topic::with(['user', 'comments.replies'])->latest()->get();

    // Menghitung jumlah total replies untuk setiap topik
    foreach ($topics as $topic) {
        $topic->reply_count = $topic->comments->sum(function ($comment) {
            return $comment->replies->count();
        });
    }

    return view('community.index', compact('topics'));
}


    // Membuat topik baru
    public function storeTopic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
            $imagePath = $request->file('image') ? $request->file('image')->store('posts', 'public') : null;

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'image_path'
        ]);

        return redirect()->route('community.index')->with('success', 'Topik baru berhasil dibuat.');
    }

    // Menambahkan komentar ke topik
    public function storeComment(Request $request, $topicId)
    {
        // dd($request->all());

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
    public function editTopic($id)
    {
        $topic = Topic::findOrFail($id);

        // Memastikan hanya pemilik topik yang bisa mengedit
        if ($topic->user_id != auth()->id()) {
            abort(403); // Unauthorized
        }

        return view('community.edit-topic', compact('topic'));
    }

    public function updateTopic(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        // Memastikan hanya pemilik topik yang bisa mengedit
        if ($topic->user_id != auth()->id()) {
            abort(403); // Unauthorized
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('community.show', $id)->with('success', 'Topik berhasil diperbarui.');
    }

    public function deleteTopic($id)
    {
        $topic = Topic::findOrFail($id);

        // Memastikan hanya pemilik topik yang bisa menghapus
        if ($topic->user_id != auth()->id()) {
            abort(403); // Unauthorized
        }

        $topic->delete();

        return redirect()->route('community.index')->with('success', 'Topik berhasil dihapus.');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Memastikan hanya pemilik komentar yang bisa menghapus
        if ($comment->user_id != auth()->id()) {
            abort(403); // Unauthorized
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }

    public function deleteReply($id)
    {
        $reply = Reply::findOrFail($id);

        // Memastikan hanya pemilik balasan yang bisa menghapus
        if ($reply->user_id != auth()->id()) {
            abort(403); // Unauthorized
        }

        $reply->delete();

        return redirect()->back()->with('success', 'Balasan berhasil dihapus.');
    }

}
