<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use Illuminate\Http\Request;
use Exception;

class LocationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $location = DB::table('locations')
            ->join('location_codes', 'location_codes.id', '=', 'locations.lc')
            ->select('locations.id','locations.name','locations.city','location_codes.lc','location_codes.description')
            ->get();
            return response()->json([
                'message' => 'Campaigns List',
                'code' => 200,
                'data' => $location,
            ]);
        }catch(Exception $e){
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
        DB::beginTransaction();
        $validateData = $request->validate([
            'name'        => 'required',
            'lc'          => 'required',
            'city'        => 'required',
        ]);
        try {
            $location             = new Location;
            $location->name       = $request->name;
            $location->lc         = $request->lc;
            $location->city       = $request->city;
            $location->save();
            if ($location) {
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => $location
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'status' => '202',
                'data' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $location = Location::select('*')->find($id);
            return response()->json([
                'message' => 'Location info',
                'code' => 200,
                'data' => $location
            ]);

        } catch(Exception $e)
        {
            return response()->json([
                'status' => '202',
                'data' => $e->getMessage()
            ]);
        }
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
        DB::beginTransaction();
        $request->validate([
            'editName' => 'required',
            'editLc' => 'required',
            'editCity' => 'required',
        ]);
        try {
            $location = Location::find($id);
            $location->name = $request->editName;
            $location->lc = $request->editLc;
            $location->city = $request->editCity;
            $location->save();
            if ($location) {
                DB::commit();
                return response()->json([
                    'message' => 'Location updated',
                    'status' => 200,
                    'data' => $location
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'status' => '202',
                'data' => $e->getMessage()
            ]);
        }
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
