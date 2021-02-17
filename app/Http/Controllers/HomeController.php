<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vehicles = Vehicle::select("*")->where("owner_id", "=", auth()->user()->id)->get();


        return view('home')->with('vehicles', $vehicles);
    }

    public function markRead($id){
        auth()->user()->unreadNotifications->find($id)->markAsRead();
        $vehicle_id = request('id');
        
        return redirect('/details/'.$vehicle_id);
    }
}
