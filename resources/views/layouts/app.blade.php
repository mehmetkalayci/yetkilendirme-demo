<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('permissions.index') }}">Permissions</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}">Posts</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Reports</a></li>
                    </ul>
                    <span class="navbar-text ms-auto">
                        @if(auth()->check())
                            {{ auth()->user()->name }}
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-link">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-link">Login</a>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-4">
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
