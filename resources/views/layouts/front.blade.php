<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,300italic,400italic|Roboto+Condensed:400,300,400italic,300italic|Open+Sans:400,300,300italic,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/styles.css')}}" rel="stylesheet">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-dark navbar-sticky-top bg-primary">
        <a href="/" class="navbar-brand">Нить</a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
             <a href="/" class="nav-link">Главная</a>
            </li>
            <li class="nav-item">
                <a href="/about" class="nav-link">О нас</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Каталог</a>
            </li>
            <li class="nav-item">
                <a href="/news" class="nav-link">Новости</a>
            </li>
            <li class="nav-item">
                <a href="/contacts" class="nav-link">Контакты</a>
            </li>
        </ul>
    </nav>
    @yield('content')
</div>
<!-- jQuery first, then Bootstrap JS. -->
<script src="{{asset('assets/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.js')}}"></script>
</body>
</html>

