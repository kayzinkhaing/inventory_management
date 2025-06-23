@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="mb-4">Add Brand</h2>

    <form action="{{ route('brands.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Brand Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
    </form>
  </div>
@endsection
