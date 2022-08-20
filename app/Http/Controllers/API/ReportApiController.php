<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class ReportApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = DB::table('donations')
        ->select(DB::raw('COUNT(id) as count '))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
        $donators = DB::table('donators')
        ->select(DB::raw('COUNT(id) as count'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get()->toArray();
        foreach($donations as $key => $value) {
            $donation[]=$value->count;
        }
        foreach($donators as $key => $value) {
            $donator[]=$value->count;
        }
        return response()->json([
            'donation' => $donation,
            'donators' => $donator  
        ]);
    }

    public function bloodBag() 
    {
       $missing_blood_types = DB::table('blood_types')
        ->select('blood_types.blood_type')
        ->whereNotExists(function ($query) {
            $query->from('blood_bags')
                ->select('blood_type')
                ->where('blood_bags.blood_type','=',DB::raw('blood_types.blood_type'));
        })
        ->get();

        $alert_quantity = DB::table('blood_bags')
        ->select('blood_type','quantity_cc')
        ->where('quantity_cc', '<', 10 )
        ->get();
        return response()->json([
            'missing_blood_type' => $missing_blood_types,
            'alert_quantity' => $alert_quantity
        ]);
    }

    public function getReport () {
        try {
            $report = DB::table('donations')
            ->leftJoin('locations','donations.location_id','=','locations.id')
            ->leftJoin('donators','donations.donator_id','=','donators.id')
            ->select('donators.blood_type', DB::raw("SUM(donations.quantity) as quantity"), 'locations.name', DB::raw("DATE(donations.created_at) as date"))
            ->groupBy('donations.location_id', DB::raw('DATE(donations.created_at)'), 'donators.blood_type')
            ->get();
            return response()->json([
                'message' => 'Blood bag List',
                'code' => 200,
                'data' => $report
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ]);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
