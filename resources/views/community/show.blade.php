<x-community.layout>
    <div class="container">
        <h1>{{ $topic->title }}</h1>
        <p>{{ $topic->description }}</p>
        <p>Oleh: {{ $topic->user->name }}</p>

        <hr>

        <h2>Komentar</h2>
        @foreach ($topic->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p>{{ $comment->body }}</p>
                    <p>Oleh: {{ $comment->user->name }}</p>

                    @foreach ($comment->replies as $reply)
                        <div class="ml-4 mt-2">
                            <p>{{ $reply->body }}</p>
                            <p>Oleh: {{ $reply->user->name }}</p>
                        </div>
                    @endforeach

                    <form action="{{ route('community.storeReply', $comment->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="body">Balas</label>
                            <textarea name="body" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </form>
                </div>
            </div>
        @endforeach

        <form action="{{ route('community.storeComment', $topic->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">Komentar</label>
                <textarea name="body" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>
    </div>
</x-community.layout>
