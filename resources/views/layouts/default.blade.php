<!doctype html>
<html lang="fr">
<head>
    @include('includes.head')
</head>
    <body>

        <!-- header content -->
        @include('includes.header')

        <!-- sidebar content -->
        @include('includes.sidebar')

        <!-- main content -->
        @yield('content')

        @include('includes.footer')

    </body>
</html>