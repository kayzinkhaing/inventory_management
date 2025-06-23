<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Inventory</a>

    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('brands.index') }}">Brands</a></li>
    </ul>

    <ul class="navbar-nav ms-auto">
      {{-- If user is not logged in --}}
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      @endguest

      {{-- If user is logged in --}}
      @auth
        <li class="nav-item">
          <span class="navbar-text text-white me-2">
            {{ Auth::user()->name }}
          </span>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
      @endauth
    </ul>
  </div>
</nav>
