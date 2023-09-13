<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mentee Project</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/profile/profile.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}" />
</head>
<body class="login">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4"> 
                        <a href="/" class="logo d-flex align-items-center w-auto">
                            <img class="img-fluid" src="{{ asset('images/logo/logo.png') }}" alt="" width="200" loading="lazy">
                        </a>
                    </div>
                    <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-3 pb-2">
                            <h3 class="text-center pb-0">Login to Admin Account</h3>
                            <p class="text-center">Enter admin email & password to login</p>
                        </div>

                        @if (Session::get('fail'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('fail') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="row g-3" action="{{ route('admin.login_handler') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="yourEmail" class="form-label h6">Email</label>
                                <input type="text" name="email" class="form-control" id="yourEmail" value="{{ old('email') }}">
                                @error('email')
                                    <small class="alert text-danger ps-0">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" autocomplete="on">
                                @error('password')
                                    <small class="alert text-danger ps-0">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 my-4">
                                <button class="btn w-100" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>