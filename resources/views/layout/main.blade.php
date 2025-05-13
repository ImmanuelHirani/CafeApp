<!DOCTYPE html>
<html lang="en">

<head>
    @yield('meta')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body>
    @include('layout.Navbar')
    <main>
        @yield('content')
        @include('layout.popovers.aside.sidebar-frontend')
        @include('layout.modal.login-registerBox.Auth-Customer')
    </main>
    @include('layout.Footer')
</body>
@yield('script')


</html>