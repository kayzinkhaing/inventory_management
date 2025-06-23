@extends('layouts.app')

@section('content')
<h2>Product Details</h2>
<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Code:</strong> {{ $product->code }}</p>
<p><strong>Brand:</strong> {{ $product->brand->name ?? '' }}</p>
<p><strong>Category:</strong> {{ $product->category->name ?? '' }}</p>
<p><strong>Price:</strong> ${{ $product->price }}</p>
<p><strong>Quantity:</strong> {{ $product->quantity }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>
<p><strong>Image:</strong></p>
<img src="{{ asset('storage/'.$product->image) }}" width="150">
@endsection
