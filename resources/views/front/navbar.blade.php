<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('front.index') }}">Merchandise</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Move these buttons to the right -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    @auth
                    <a class="btn btn-outline-dark mr-2" href="{{ route('front.cart') }}">
                        <i class="bi-cart-fill me-1"></i>
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count(auth()->user()->keranjang ?? []) }}</span>
                    </a>
                    @else
                        <!-- Tampilkan tombol cart tanpa jumlah saat pengguna belum terotentikasi -->
                        <a class="btn btn-outline-dark mr-2" href="{{ route('front.cart') }}">
                            <i class="bi-cart-fill me-1"></i>
                        </a>
                    @endauth
                </li>
                <li class="nav-item">
                    @auth
                    <a class="btn btn-outline-dark mr-2" href="{{ route('wishlist.index') }}">
                        <i class="bi-heart-fill me-1"></i>
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count(auth()->user()->wishlist ?? []) }}</span>
                    </a>
                    @else
                    <a class="btn btn-outline-dark mr-2" href="{{ route('wishlist.index') }}">
                        <i class="bi-heart-fill me-1"></i>
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </a>
                    @endauth
                </li>
                <li class="nav-item">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="bi-person-fill me-1"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Add dropdown items here (e.g., profile, logout) -->
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    @else
                        <!-- Show Sign In link when the user is not authenticated -->
                        <a class="btn btn-outline-dark" href="{{ route('login.page') }}">
                            Sign In
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
