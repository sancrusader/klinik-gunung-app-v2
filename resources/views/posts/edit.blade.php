<h1>Edit Post</h1>

<form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
    </div>

    <div class="form-group">
        <label for="content">Content:</label>
        <textarea name="content" id="content" class="form-control" required>{{ $post->content }}</textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags (comma separated):</label>
        <input type="text" name="tags" id="tags" class="form-control"
            value="{{ implode(', ', $post->tags) }}">
    </div>

    <div class="form-group">
        <label for="author_name">Author Name (Optional):</label>
        <input type="text" name="author_name" id="author_name" class="form-control" value="{{ $post->author_name }}">
    </div>

    <div class="form-group">
        <label for="author_profile_picture">Author Profile Picture (Optional):</label>
        @if ($post->author_profile_picture)
            <img src="{{ Storage::url($post->author_profile_picture) }}" alt="Current Author Profile Picture"
                width="100">
        @endif
        <input type="file" name="author_profile_picture" id="author_profile_picture" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
