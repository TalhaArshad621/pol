<?php

namespace App\Http\Controllers;

use App\Models\BloodBag;
use App\Models\Donation;
use App\Models\Donator;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $donator = $this->donatorcount();
        $donation = $this->donationCount();
        $blood_bags = BloodBag::get();
        return view('home', compact('donator','donation','blood_bags'));
    }

    protected function donatorcount(){
        $data = Donator::whereMonth('created_at', Carbon::now()->month)
            ->count();
        return $data;
    }

    protected function donationCount(){
        $data = Donation::whereDay('created_at', Carbon::now()->day)
        ->count();
        return $data;
    }
}
