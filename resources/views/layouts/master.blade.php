<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('/js/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
    
<body>
@section('header')
    <nav class="header-nav">
        <li id="home"><a href="{{url('steam/home')}}">Steam Account Lookup</a></li>
    </nav>
    @show
    <br>
        <div class="container">
            @yield('content')
        </div>
</body>
</html>