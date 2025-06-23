@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="mb-4">Edit Brand</h2>

    <form action="{{ route('brands.update', $data->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name" class="form-label">Brand Name</label>
        <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
    </form>
  </div>
@endsection
