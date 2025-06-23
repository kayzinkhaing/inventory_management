@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Product</h2>

        <form action="{{ route('products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required
                    value="{{ old('name', $data->name) }}">
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                <input type="text" id="code" name="code" class="form-control" required
                    value="{{ old('code', $data->code) }}">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="" disabled>-- Select Category --</option>
                    @foreach ($categoryDropdown as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('category_id', $data->category_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="brand_id" class="form-label">Brand</label>
                <select id="brand_id" name="brand_id" class="form-select">
                    <option value="" {{ old('brand_id', $data->brand_id) ? '' : 'selected' }}>-- Optional --</option>
                    @foreach ($brandDropdown as $id => $name)
                        <option value="{{ $id }}" {{ old('brand_id', $data->brand_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required
                    value="{{ old('price', $data->price) }}">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" id="quantity" name="quantity" class="form-control" required
                    value="{{ old('quantity', $data->quantity) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Current Images</label>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach ($data->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" width="100" height="100"
                            class="border rounded">
                    @endforeach
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-3">
                <x-file-upload id="imageInput" name="image[]" label="Upload New Images" accept="image/*" multiple />
                <!-- Note: Not required, so no 'required' attribute -->
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="4" class="form-control">{{ old('description', $data->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
