<?php

namespace App\Http\Controllers;

use App\Models\BloodBag;
use App\Models\Donation;
use App\Models\Donator;
use App\Models\PreExam;
use Carbon\Carbon;
use DonationTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\Table\Table;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('donation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donation.create');
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
                return Redirect::to("donations")->withSuccess('Donation has been made!');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return Redirect::to('/donate-blood')->withErrors($validator); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
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
