<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('donator.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function show($donator)
    {
        $donation = $this->donation($donator);
        $preExam  = $this->preExam($donator);
        $donator =  DB::table('donators')->select('*')->where('id',$donator)->first( );
        return view('donator.show', compact('donation','donator','preExam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function edit(donator $donator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, donator $donator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function destroy(donator $donator)
    {
        //
    }

    protected function donation($id)
    {
        $donation = DB::table('donations')->join('locations','donations.location_id','=','locations.id')->select('donations.quantity','donations.donation_type','donations.created_at','locations.name')->where('donations.donator_id','=',$id)->get();
        return $donation;
    }
    protected function preExam($id)
    {
        $preExam = DB::table('donations')->join('pre_exams', 'donations.pre_exam','=','pre_exams.id')->select('donations.pre_exam','pre_exams.*')->where('donations.donator_id',$id)->get();
        return $preExam;
    }

}
