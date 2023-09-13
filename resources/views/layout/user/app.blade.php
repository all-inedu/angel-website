<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danya Website</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/profile/profile.png') }}" />
    <link rel="stylesheet" href="{{asset('build/assets/app-8e388908.css')}}">
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>
    {{-- Header --}}
    @include('layout.user.header')
    {{-- End Header --}}

    {{-- Main --}}
    <main>
        @yield('main')
    </main>
    {{-- End Main --}}

    {{-- Footer --}}
    @include('layout.user.footer')
    {{-- End Footer --}}
</body>

</html>
