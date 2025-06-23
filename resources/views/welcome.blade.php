@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome, KK!</p>

    <div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Manage Categories</a>
        <a href="{{ route('brands.index') }}" class="btn btn-info">Manage Brands</a>
    </div>
</div>
@endsection
