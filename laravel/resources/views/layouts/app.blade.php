<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>MMIRévision - @yield('title')</title>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <link rel="stylesheet" href="{{url('/css/grillade.css')}}">
    <link rel="stylesheet" href="{{url('/css/bootstrap.css')}}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{url('/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{url('/css/animate.css')}}">

</head>
<body>
<header class="grid-2-1 header wow fadeInDown">
    <div>
        <a href="{{url('/home')}}"><img src="/~tony/images/logo.png" alt="logo" class="logo"></a>
    </div>
    <div class="grid-3">
        @if(Auth::user())
            <div class="first" style="margin-right:50px;">
                {!! Form::open(['method'=>'post', 'url'=> route('recherche')]) !!}
                <input type="text" name="research" placeholder="Recherche ..."/>
                {{Form::close()}}
            </div>
            <div><img src="/~tony/img/avatars/{{Auth::user()->avatar}}" alt="Photo de %étudiant%" id="avatar" class="ico floatL">
                <p style="margin-left:5px;" class="user"><a href="{{url('/profil')}}"
                                               style="color:white;">{{Auth::user()->prenom}}</a>
                    <a href="{{url('/logout')}}"><i class="fa fa-power-off" style="color:white; margin-left:10px;"></i></a>
                </p></div>
        @else
            <p class="first">
                <i class="fa fa-sign-in" style="color:white;"></i> <a href="{{url('login')}}" style="color:white;">Connexion</a>
            </p>
        @endif
    </div>

</header>
<section class="grid-12" style="background-color:#f3f3f3;">

    @include('sidebar')

    <div class="article flex-item-plus" style="padding-top:100px;">

        @include('flash')
        @yield('content')

    </div>
</section>
</body>
<script src="{{url('/js/jquery.js')}}"></script>
<script src="{{url('/js/bootstrap.js')}}"></script>
<script src="{{url('/js/summernote.min.js')}}"></script>
<script src="{{url('/js/laravel.js')}}"></script>
<script src="{{url('/js/wow.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
    new WOW().init();
    $('.datepicker').datepicker();
</script>
<script>
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1) {
                $('.header').addClass('sticky');
                $('.user').addClass('sticky');
                $('#avatar').addClass('sticky');
                $('.logo').addClass('sticky');
            }
            else {
                $('.header').removeClass('sticky');
                $('.user').removeClass('sticky');
                $('#avatar').removeClass('sticky');
                $('.logo').removeClass('sticky');
            }
        });
    });
</script>
</html>