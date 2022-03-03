<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between" style="background-color:#33313b">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{asset('logo.png')}}" height="42" class="d-inline-block align-top mr-3" alt="" loading="lazy">
            Fitness
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                @auth
                <li class="nav-item {{Request::is('pendaftaran') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('pendaftaran.index')}}">Pengunjung</a>
                </li>
                <li class="nav-item {{Request::is('absensi') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('absensi.index')}}">Absensi</a>
                </li>
                {{-- <li class="nav-item {{Request::is('instruktur') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('instruktur.index')}}">Instruktur</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{Request::is('transaksi') ? 'active' : ''}}" href="{{route('transaksi.index')}}">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::is('ganti-password') ? 'active' : ''}}" href="{{route('user.change-password')}}">Ganti Password</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{Request::is('laporan') ? 'active' : ''}}" href="{{route('laporan.index')}}">Laporan</a>
                </li> --}}
                <li class="nav-item">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="btn nav-link" type="submit" class="nav-link">Logout</button>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success mt-3" role="alert" id="success-alert">
                <h4 class="alert-heading h5">Berhasil!</h4>
                <p>{{session('success')}}</p>
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('success-alert').remove()
                }, 2000);
            </script>
            @endif
        </div>
    </div>
    @yield('content')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
