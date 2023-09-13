<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danya Website</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/profile/profile.png') }}" />

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.css">

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    {{-- Datatables --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css"/>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js" defer></script>

    {{-- Tables Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}" />
    @yield('css')
</head>

<body>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" style="min-height: 100vh">
        
        <!-- Sidebar -->
        @include('layout.admin.sidebar')

        <!-- Main Wrapper -->
        <div class="body-wrapper">
            
            <!-- Header -->
            @include('layout.admin.header')

            <!-- Content -->
            <div class="container-fluid d-flex flex-column gap-md-3">
                @yield('content')
                @include('admin.change_password.index')
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    @yield('js')
    <script>
        function notification(status, message) {
            const Toast = Swal.mixin({
                toast: true,
                width: 500,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: status,
                title: message
            })
        }
    </script>
    @if (Session::has('success'))
        <script>
            notification('success', '{{ Session::get('success') }}')
        </script>
    @endif
    @if (Session::has('errors'))
        <script>
            notification('error', '{{ Session::get('errors')->first() }}')
        </script>
    @endif
    <script>
        $(document).ajaxComplete(function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });
    </script>
</body>

</html>