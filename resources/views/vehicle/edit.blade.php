@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a Car') }}</div>

                <div class="card-body">
                    <form method="POST" action="/edit/{{$vehicle->id}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-1">
                            <label for="make" class="col-md-4 col-form-label text-md-right">{{ __('Car Make') }}</label>

                            <div class="col-md-6">
                                <input id="make" type="text" class="form-control @error('make') is-invalid @enderror" name="make" value="{{$vehicle->make}}" required autocomplete="off">

                                @error('make')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="model" class="col-md-4 col-form-label text-md-right">{{ __('Car Model') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{$vehicle->model}}" required autocomplete="off">

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$vehicle->price}}" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Buy Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{$vehicle->status}}" autocomplete="off">

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label for="vehicle_image" class="col-md-4 col-form-label text-md-right">{{ __('Car Image') }}</label>

                            <div class="col-md-6">
                                <input id="vehicle_image" type="file" class="form-control @error('vehicle_image') is-invalid @enderror" name="vehicle_image">

                                @error('vehicle_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection