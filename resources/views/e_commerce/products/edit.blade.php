<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                    style="max-width: 100px; margin-top: 10px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
