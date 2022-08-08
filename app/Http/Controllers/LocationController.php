<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\PreExam;
use Carbon\Carbon;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodBag;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location_code = LocationCode::select("id","lc")->get();
       return view('campaign.index',compact('location_code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('campaign.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'donor_id'      => 'required',
            'blood_amount'  => 'required',
            'donation_type' => 'required',
            'hemoglobin_gDl'=> 'required',
            'temperature'   => 'required',
            'blood_pressure'=> 'required',
            'pulse_rate_BPM'=> 'required'
        ]);
        try {
            $pre_exam = new PreExam;
            $pre_exam->hemoglobin_gDl = $request->hemoglobin_gDl;
            $pre_exam->temperature_F  = $request->temperature;
            $pre_exam->blood_pressure = $request->blood_pressure;
            $pre_exam->pulse_rate_BPM = $request->pulse_rate_BPM;
            $pre_exam->save();
            $donation = new Donation;
            $donation->donator_id    = $request->donor_id;
            $donation->quantity      = $request->blood_amount;
            $donation->donation_type = $request->donation_type;
            $donation->created_by    = Auth::user()->id;
            $donation->pre_exam      = $pre_exam->id;
            $donation->location_id   = $request->location_id;
            $donation->save();
            if ($donation) {
                $getNextDonationDate = DB::table('donation_types')->select('frequency_days')->where('type','=',$request->donation_type)->first();
                $date = Carbon::now()->addDays($getNextDonationDate->frequency_days);
                $updateDonator = DB::table('donators')
                ->where('id', $request->donor_id)
                ->limit(1)
                ->update(array('nextSafeDonationDate' => $date->format('Y-m-d')));
                $donator = $this->getDonator($request->donor_id);
                
               $check = $this->checkBloodBag($donator->blood_type,$request->donation_type);
               if($check){
                   $updateBloodBag = DB::table('blood_bags')
                   ->where('blood_type' , '=', $donator->blood_type)
                   ->where('donation_type', '=',$request->donation_type)
                   ->increment('quantity_cc' ,  $request->blood_amount);
               } else {
                $blood_bag = new BloodBag;
                $blood_bag->donation_type = $request->donation_type;
                $blood_bag->quantity_cc   = $request->blood_amount;
                $blood_bag->blood_type    = $donator->blood_type; 
                $blood_bag->save();
               }
               DB::commit();
               $redirect_url = 'campaign-create/'. $request->location_id;
                return Redirect::to($redirect_url)->withSuccess('Donation has been made!');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return Redirect::to('/campaign-create')->withErrors($validator); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }

    
    protected function getDonator($id){
        $donator = DB::table('donators')->select('*')->where('id', '=' , $id)->first();
        return $donator;
    }
    protected function checkBloodBag($blood_type, $donation_type){
        $blood_bag = DB::table('blood_bags')->select("*")->where('blood_type', '=', $blood_type)->where('donation_type', '=', $donation_type)->first();
        return $blood_bag;
    }
}
