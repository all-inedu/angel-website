{{-- @extends('errors::minimal') --}}

{{-- @section('title', __('Not Found')) --}}
{{-- @section('code', '404') --}}
{{-- @section('message', __('Not Found')) --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danya Website</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/profile/profile.png') }}" />

    @vite('resources/css/app.css')
</head>

<body>

    {{-- Start Section: Custom 404 Page --}}
    <main>

        <section class="h-screen w-full flex justify-center items-center bg-primary-light">
            <div class="flex flex-col items-center gap-2">
                <h4 class="-mb-2 font-primary font-medium  text-3xl text-primary lg:text-4xl lg:-mb-0">
                    Error 404 - Page Not Found
                </h4>
                <span class="font-secondary font-normal text-base text-grey lg:text-xl text-center">
                    The page you requested could not be found.
                    <br>
                    We're working on it :)
                </span>
                <a href="/"
                    class="mt-8 p-2 px-4 bg-primary font-secondary font-bold text-sm text-light lg:text-base">
                    Back Home
                </a>
            </div>
        </section>
        {{-- End Section: Custom 404 Page --}}
    </main>

</body>

</html>
