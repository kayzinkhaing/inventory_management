@extends('layouts.app')

@section('content')
  <h2>Edit Category</h2>

  <form action="{{ route('categories.update', $data->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
  </form>
@endsection
