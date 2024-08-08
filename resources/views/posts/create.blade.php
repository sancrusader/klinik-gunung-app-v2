<h1>Create New Post</h1>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="content">Content:</label>
        <textarea name="content" id="content" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags (comma separated):</label>
        <input type="text" name="tags" id="tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="author_name">Author Name (Optional):</label>
        <input type="text" name="author_name" id="author_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="author_profile_picture">Author Profile Picture (Optional):</label>
        <input type="file" name="author_profile_picture" id="author_profile_picture" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
