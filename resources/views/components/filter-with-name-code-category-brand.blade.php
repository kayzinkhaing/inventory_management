<form method="GET" action="{{ route('products.filter') }}" class="row mb-4">
    <div class="col-md-3">
        <input type="text" name="search" class="form-control" placeholder="Search by name or code" value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="category_id" class="form-control">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="brand_id" class="form-control">
            <option value="">-- Select Brand --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary" type="submit">Filter</button>
        <a href="{{ route('products.filter') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
