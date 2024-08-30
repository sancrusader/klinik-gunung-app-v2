{{-- Membuat Produk --}}
<h1>Add Product</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
