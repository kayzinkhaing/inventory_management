@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mb-4">Brands</h1>

    <a href="{{ route('brands.create') }}" class="btn btn-success mb-3">+ Add Brand</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Products Count</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($brands as $brand)
          <tr>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->products->count() }}</td>
            <td>
              <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
