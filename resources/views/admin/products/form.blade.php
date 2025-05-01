<div class="card shadow p-3 custom-scroll submain">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control form-control-md" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control form-control-md" id="description" name="description" rows="2" placeholder="Provide a brief description">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" step="0.01" class="form-control form-control-md" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="0.00">
        </div>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control form-control-md" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}" placeholder="Available quantity">
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control form-control-md" id="category" name="category" value="{{ old('category', $product->category ?? '') }}" placeholder="e.g., Electronics, Books">
    </div>

    <div class="mb-3">
        <label for="image_path" class="form-label">Image</label>
        <input type="file" class="form-control form-control-md" id="image_path" name="image_path">
        @if (!empty($product->image_path))
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-thumbnail mt-3" style="max-width: 150px;">
        @endif
    </div>
</div>

<style>
    .submain {
        min-height: 75vh;
        overflow-y: auto; 
        margin: 15px; 
        background: #ffffff ; 
        border-radius: 5px;
    } 
    
    .custom-scroll {
        max-height: 200px;
        overflow-y: scroll;
        padding-right: -8px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,0,0,0.2) transparent;
        position: relative;
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 130px) !important;
            overflow-y: scroll !important;
            margin: 0px !important;
        }
    }
    @media (max-height: 700px) and (max-width: 767px) {
        .submain{
            min-height: 10vh !important;
            max-height: calc(85vh - 150px) !important;
            border: 1px solid red;
        }
    }
</style>