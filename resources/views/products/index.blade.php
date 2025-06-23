@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mb-4">Product List</h1>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Add Product</a>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('products.index') }}" class="mb-4 row g-3">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search by name/code" value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <select name="category_id" class="form-select">
          <option value="">All Categories</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select name="brand_id" class="form-select">
          <option value="">All Brands</option>
          @foreach($brands as $brand)
            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
              {{ $brand->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
    </form>

    {{-- Your existing table here --}}
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Code</th>
          <th>Category</th>
          <th>Brand</th>
          <th>Description</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Stock Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td>{{ $product->brand->name ?? '-' }}</td>
            <td>{{ $product->description ?? '-' }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>{{ $product->quantity }}</td>
            <td>${{ number_format($product->price * $product->quantity, 2) }}</td>
            <td>
              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="10" class="text-center">No products available.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
