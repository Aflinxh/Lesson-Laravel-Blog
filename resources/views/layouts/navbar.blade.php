<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Home' ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'About' ? 'active' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Posts' ? 'active' : '' }}" href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Categories' ? 'active' : '' }}" href="/categories">Categories</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto text-decoration-none">
                @auth
                    <li class="nav-item">
                        <a href="/dashboard" class="text-decoration-none"><i class="bi bi-house-door-fill"></i> Dashboard</a>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a href="/register" class="text-decoration-none"><i class="bi-person-fill-up"></i> Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="text-decoration-none"><i class="bi-box-arrow-in-right"></i> Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>