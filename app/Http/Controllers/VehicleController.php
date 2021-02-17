<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddMail;
use App\Mail\BuyMail;
use Image;
use App\Notifications\NotifyUser;
use DB;

class VehicleController extends Controller
{
    public function index(){
        return view('vehicle.create');
    }

    public function create(){
        $vehicle = new Vehicle();

        // $val = request()->validate([
        //     'image' => 'image|max:2048'
        // ]);

        $vehicle->owner_id = auth()->user()->id;
        $vehicle->make = request('make');
        $vehicle->model = request('model');
        $vehicle->price = request('price');

        // dd(Image::make(request('image')));
        
        $image_file = request()->file('vehicle_image');
        error_log("------------".$image_file);
        $image = Image::make($image_file);
        Response::make($image->encode('jpeg'));
        $vehicle->vehicle_image = $image;

        $vehicle->save();

        $email = auth()->user()->email;
        $message = "Added the car Make: ".$vehicle->make." , Model: ".$vehicle->model." successfully.";
        $details = [
            'message' => $message
        ];
        Mail::to($email)->send(new AddMail($details));

        $users = User::all();
        foreach($users as $user){
            if(auth()->user()->id !== $user->id) $user->notify(new NotifyUser($vehicle));
        }

        return redirect()->route('home');
    }

    public function show(){
        $allVehicles = Vehicle::all();

        $vehicles = [];

        foreach($allVehicles as $vehicle){
            if(Auth::user()){
                if($vehicle->owner_id != auth()->user()->id) array_push($vehicles, $vehicle);
            }else array_push($vehicles, $vehicle);
        }

        return view('show')->with('vehicles', $vehicles);
    }
    
    public function details($id){
        $vehicle = Vehicle::find($id);

        return view('details')->with('vehicle', $vehicle);
    }

    public function fetchImage($id){
        $vehicle = Vehicle::findOrFail($id);
        $image_file = Image::make($vehicle->vehicle_image);
        $response = Response::make($image_file->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    public function edit($id){
        $vehicle = Vehicle::find($id);

        return view('vehicle.edit')->with('vehicle', $vehicle);
    }

    public function update($id){
        $vehicle = Vehicle::find($id);

        $vehicle->owner_id = auth()->user()->id;
        $vehicle->make = request('make');
        $vehicle->model = request('model');
        $vehicle->price = request('price');
        $vehicle->status = request('status');

        if(request()->file('vehicle_image') != null){
            $image_file = request()->file('vehicle_image');
            error_log("------------".$image_file);
            $image = Image::make($image_file);
            Response::make($image->encode('jpeg'));
            $vehicle->vehicle_image = $image;
        }

        $vehicle->save();

        return redirect()->route('home')->with('status', 'Updated car succesfully!');
    }

    public function delete($id){
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('home')->with('status', "Deleted vehicle successfully!");
    }

    public function purchase($id){
        $vehicle = Vehicle::find($id);
        $owner = User::find($vehicle->owner_id);
        $user = User::find(auth()->user()->id);
        
        $balance = $user->money;
        $ownerAmount = $owner->money;
        $price = $vehicle->price;

        if($balance >= $price){
            $user->money = $balance - $price;
            $owner->money = $ownerAmount + $price;
            $vehicle->status = 'sold';
            $user->save();
            $owner->save();
            $vehicle->save();

            $buyerEmail = auth()->user()->email;
            $buyerMessage = "Bought the car Make: ".$vehicle->make." , Model: ".$vehicle->model." successfully 
                        for $".$vehicle->price.". Current balance: ".($balance - $price);
            $buyerDetails = [
                'message' => $buyerMessage
            ];
            Mail::to($buyerEmail)->send(new BuyMail($buyerDetails));

            $sellerEmail = $owner->email;
            $sellerMessage = "Car Make: ".$vehicle->make." , Model: ".$vehicle->model." is successfully 
                        sold for $".$vehicle->price.". Current balance: ".($ownerAmount + $price);
            $sellerDetails = [
                'message' => $sellerMessage
            ];
            Mail::to($sellerEmail)->send(new BuyMail($sellerDetails));

            return redirect()->route('home')->with('status', 'Car bought successfully!');
        }

        return redirect()->back()->with('msg', 'Insufficient balance');
    }

    public function search(Request $request){
        if($request->ajax()){
            $output = "";
            $vehicles=DB::table('vehicles')->where('make','LIKE','%'.$request->search."%")->get();

            if($vehicles){
                foreach($vehicles as $vehicle){
                    $output .= '<div class="card">'.
                        '<img src="/fetch_image/'.$vehicle->id.'" alt="Car Image" class="card-img">'.
                        '<div class="card-content">'.
                            '<p>Car Make: '.$vehicle->make.'</p>'.
                            '<p>Car Model: '.$vehicle->model.'</p>'.
                            '<p>Car Price: '.$vehicle->price.'</p>'.
                        '</div>'.
                        '<div class="card-info">'.
                            '<div>'.
                                '<a href="/details/'.$vehicle->id.'" class="card-link">Buy Car</a>'.
                            '</div>'.
                        '</div>'.
                    '</div>';
                }
            }

            return Response($output);
        }
    }
}