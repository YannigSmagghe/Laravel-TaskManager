<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <title>{{ config('app.name', 'Task Manager') }}</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Simple Task Manager using Laravel 5">
        <meta name="author" content="Mahip Kaushal">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <link rel="shortcut icon" href="favicon.ico"> -->  
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <script type="text/javascript" src="{{ asset('js/jquery.3.1.1.min.js') }}"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head> 

    <body>
        
        @include('partials.header')

        @yield('content')

        @include('partials.footer')
        
        <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    </body>
</html>