<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- SB Admin 2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                {{-- Topbar --}}
                @include('layouts.partials.topbar')

                {{-- Main Content --}}
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            {{-- Footer --}}
            @include('layouts.partials.footer')

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>

</body>

</html>