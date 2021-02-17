<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car Warehouse</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/details.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('show') }}">Explore</a></li>
                @if(Auth::user()->admin == 1)
                    <li><a href="{{ route('create') }}">Add a Car</a></li>
                @endif
                <li><a href="{{ route('home') }}">Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="card">
            <div class="vehicle">
                <div class="circle"></div>
                <img src="/fetch_image/{{$vehicle->id}}" alt="Vehicle Image">
                {{-- <img src="https://fakeimg.pl/200x100/?retina=1&text=こんにちは&font=noto" alt="Vehicle Image"> --}}
            </div>
            <div class="info">
                <h1 class="title">{{ $vehicle->make }} - {{ $vehicle->model }}</h1>
                <h3>{{ $vehicle->price }}</h3>
                <div class="purchase">
                    <form action="/purchase/{{$vehicle->id}}" method="get">
                        <button type="submit">Purchase</button>
                    </form>
                </div>
                @if (session('msg'))
                    <div class="alert" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('js/details.js') }}"></script> --}}
</body>
</html>