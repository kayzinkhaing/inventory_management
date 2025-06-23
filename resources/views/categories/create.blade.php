@extends('layouts.app')

@section('content')
  <h2>Add Category</h2>

  <form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <button class="btn btn-primary">Save</button>
  </form>
@endsection
