<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
</div>

<div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
</div>

<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" class="form-control" value="{{ old('category', $product->category ?? '') }}">
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image_path" class="form-control">
    @if (!empty($product->image_path))
        <img src="{{ asset('storage/' . $product->image_path) }}" width="100" class="mt-2">
    @endif
</div>
