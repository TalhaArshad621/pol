<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class BBRequestApiController extends Controller
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
        try {
            DB::beginTransaction();
            $donationRequest = DB::table('patient_requests')
            ->select('*')
            ->where('id',$id)
            ->first();
            $blood_type = $donationRequest->bloodGroup;
            $quantity = $donationRequest->amount;

            $check = DB::table('blood_bags')
            ->where('blood_type', $blood_type)
            ->where('quantity_cc','>=', $quantity)
            ->decrement('quantity_cc', $quantity);

            if($check) { 
                $updateRequest= PatientRequest::find($donationRequest->id);
                $updateRequest->status = 1;
                $updateRequest->save(); 
                DB::commit();
                return response()->json([
                    'message' => 'Request Approved',
                    'data' => $check,
                    'code' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Request not Approved',
                    'data' => $check,
                    'code' => 200
                ]);
            }


        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 203
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
