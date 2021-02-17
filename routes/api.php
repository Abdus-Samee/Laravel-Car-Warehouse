<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Vehicle;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/vehicles', function(){
    $vehicles = Vehicle::all();
    
    $output = [];
    foreach($vehicles as $vehicle){
        $url = route('fetch', ['id' => $vehicle->id]);

        $arr = array(
            'make' => $vehicle->make,
            'model' => $vehicle->model,
            'price' => $vehicle->price,
            'status' => $vehicle->status,
            'created_at' => $vehicle->created_at,
            'image_url' => $url,
        );
        array_push($output, $arr);
    }

    return $output;
});