<!doctype html>
<html>
<head>
    @include('favorite_color.includes.head')
</head>
<body>
<div class="container">
    <header class="row">
        @include('favorite_color.includes.header')
    </header>
    <div id="main" class="row">
        @yield('content')
    </div>
    <footer class="row">
        @include('favorite_color.includes.footer')
    </footer>
</div>
</body>
</html>
