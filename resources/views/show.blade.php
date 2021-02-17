<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car Warehouse</title>

    {{-- ajax link --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <nav>
            <ul class="nav-links">
                @if(Auth::check())
                    @if(Auth::user()->admin == 1)
                        <li><a href="{{ route('create') }}">Add a Car</a></li>
                    @endif
                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                @else
                    @if (Route::has('login'))
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endif
                <li><input type="text" name="search" id="search" placeholder="Search a car make"></li>
            </ul>
        </nav>
    </header>
    <div class="cards">
        @foreach ($vehicles as $vehicle)
            <div class="card">
                {{-- <img src="https://fakeimg.pl/200x100/?retina=1&text=こんにちは&font=noto" alt="Card Image" class="card-img"> --}}
                <img src="/fetch_image/{{$vehicle->id}}" alt="Car Image" class="card-img">
                <div class="card-content">
                    <p>Car Make: {{ $vehicle->make }}</p>
                    <p>Car Model: {{ $vehicle->model }}</p>
                    <p>Price: {{ $vehicle->price }}</p>
                </div>
                <div class="card-info">
                    @if($vehicle->status == 'unsold')
                        <div class="">
                            <a href="/details/{{$vehicle->id}}" class="card-link">Buy Car</a>
                        </div>
                    @else
                        <p>Car already sold!</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script type="text/javascript">
        $('#search').on('keyup', function(){
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{URL::to('search')}}',
                data: {'search': $value},
                success: function(data){
                    $('.cards').html(data);
                }
            });
        });
    </script>
</body>
</html>