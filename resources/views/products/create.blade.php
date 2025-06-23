@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Add Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
            <input type="text" id="code" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="" selected>-- Select Category --</option>
                @foreach ($categoryDropdown as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="brand_id" class="form-label">Brand</label>
            <select id="brand_id" name="brand_id" class="form-select">
                <option value="" selected>-- Optional --</option>
                @foreach ($brandDropdown as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <x-file-upload id="imageInput" name="image" label="New Images" accept="image/*" multiple required />
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" rows="4" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
