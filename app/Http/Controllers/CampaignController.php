<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            if(!Campaign::whereNull('campaign_end')
            ->where('location_id',$id)
            ->exists()){
                $campaign = new Campaign;
                $campaign->location_id = $id;
                $campaign->save();
                if($campaign){
                    DB::commit();
    
                    return response()->json([
                        'error' => false,
                        'message' => "Campaign started",
                        'data'    => $campaign,
                        'code'    => 200
                    ]);
                }
            } else {
                return response()->json([
                    'message' => "Campaign already started",
                    'code'    => 203
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
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
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }

    public function endCampaign($id) 
    {
        try {
            $date = Carbon::now();
            $end_campaign = DB::table('campaigns')
            ->where('location_id',$id)
            ->whereNull('campaign_end')
            ->update(['campaign_end'=> $date]);
            
            return response()->json([
                'message' => "Campaign Ended",
                'code'    => 200
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => "Error Occured, " . $e->getMessage(),
                'code'    => 203
            ]);
        }
    }
}
