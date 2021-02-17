@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-around">
                    <div class="">{{ __('Dashboard') }}</div>
                    <div class="">Remaining amount: {{ auth()->user()->money }}</div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 class="display-5 mt-3">Your cars</h3>
                    @if(count($vehicles) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Car Make</th>
                                <th>Car Model</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{$vehicle->make}}</td>
                                    <td>{{$vehicle->model}}</td>
                                    <td>{{$vehicle->price}}</td>
                                    <td>{{ $vehicle->status }}</td>
                                    @if($vehicle->status == 'unsold')
                                        <td><a href="/edit/{{$vehicle->id}}">EDIT</a></td>
                                        <td><a href="/delete/{{$vehicle->id}}">DELETE</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    @else 
                        <p>You have not added any cars...</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
