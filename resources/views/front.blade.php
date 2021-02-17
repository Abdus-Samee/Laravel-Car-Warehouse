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
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <nav>
                <ul>
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <li><a href="{{ route('login') }}">LOGIN</a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">REGISTER</a></li>
                        @endif
                    @endauth
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col">
                <h1>Car Warehouse</h1>
                <p>Bringing you the most easiest way of buying and selling cars!</p>
                <form action="{{ route('show') }}">
                    <button type="submit">Explore</button>
                </form>
            </div>
            <div class="col">
                <div class="card card-1">
                    <p>Buy any car of your choice and test.</p>
                </div>
                <div class="card card-2">
                    <p>Sell your car at reasonable price.</p>
                </div>
                <div class="card card-3">
                    <p>Earn handsome amount of money.</p>
                </div>
                <div class="card card-4">
                    <p>Buy and sell car in a secured way.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>