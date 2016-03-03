<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>MMIRévision - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{url('/css/font-awesome.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                MMIRevision
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
                @if(Auth::user())
                    <li><a href="{{route('nos.cours')}}">Nos cours</a></li>
                    <li><a href="{{route('voir.forum')}}">Forums</a></li>
                @endif

                @if(Auth::guest())
                @elseif(Auth::user() && Auth::user()->statut->id == 2)
                    <li><a href="{{ route('admin.dashboard') }}">Gérer mes cours</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Connexion</a></li>
                    <li><a href="{{ url('/register') }}">Inscription</a></li>
                @else

                    <img src="/laravel/public/{{Auth::user()->avatar}}" alt="" style="width:30px; border-radius:30px; margin-top:15px;">
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Déconnexion</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">

    @include('flash')
    @yield('content')

</div>

<!-- JavaScripts -->
<script src="{{ url('/js/jquery.js')}}"></script>
<script src="{{ url('/js/bootstrap.js')}}"></script>
<script src="{{ url('/js/laravel.js') }}"></script>
<script src="{{ url('/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ url('/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 300,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools',
            'table contextmenu directionality emoticons paste textcolor filemanager'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        image_advtab: true,
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
