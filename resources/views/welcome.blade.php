<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SLR ENTERPRISES</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
          crossorigin="anonymous">
</head>
<body>
<div class="">
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">SLR ENTERPRISES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                    <a class="nav-link" aria-current="page" href="">Invoice</a>
                    <a class="nav-link {{ request()->routeIs('items') ? 'active' : '' }}" href="{{ route('items') }}">Items</a>
                    <a class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}"
                       href="{{ route('categories') }}">Category</a>
                    <a class="nav-link {{ request()->routeIs('areas') ? 'active' : '' }}" href="{{ route('areas') }}">Area</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
