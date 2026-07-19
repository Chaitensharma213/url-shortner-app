<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'URL Shortner APP')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-primary text-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="{{ route('dashboard') }}" class="navbar-brand text-white fw-bold fs-3 mb-0">URL Shortner APP</a>

                <div class="fw-semibold">
                    Welcome {{ auth()->user()->name }}
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
        <div class="container">
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"  aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto gap-lg-4 gap-2 align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('dashboard') ? 'active fw-bold text-dark' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    @if(auth()->user()->role->name == 'Super Admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('companies.*') ? 'active fw-bold text-dark' : '' }}"
                           href="{{ route('companies.index') }}">
                            Companies
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('invitations.*') ? 'active fw-bold text-dark' : '' }}"
                           href="{{ route('invitations.index') }}">
                            Invitations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('short-urls.*') ? 'active fw-bold text-dark' : '' }}"
                           href="{{ route('short-urls.index') }}">
                            Short URL's
                        </a>
                    </li>

                </ul>

                <form action="{{ route('logout') }}" method="POST" class="d-flex ms-lg-auto mt-3 mt-lg-0">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>