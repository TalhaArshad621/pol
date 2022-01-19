<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\PatientRequest;


class RequestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $patientRequest = DB::table('patient_requests')->join('patients','patient_requests.patient_id', '=', 'patients.id')
            ->select('patients.id','patients.name as name','patients.age as age','patients.blood_type as blood_type','patients.gender as gender','patient_requests.*')
            ->get();
            return response()->json([
                'message' => 'Patient Request List',
                'code' => 200,
                'data' => $patientRequest
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
        // dd($request);
        DB::beginTransaction();
        $validateData = $request->validate([
            'requestName'       => 'required|string',
            'quantity'          => 'required|integer',
            'date'              => 'required|date',
            'requestAge'        => 'required|integer',
            'requestBlood_type' => 'required',
            'level'             => 'required'
        ]);
        try {
            $requests = new PatientRequest;
            $requests->patient_id  = $request->PatientId;
            $requests->amount      = $request->quantity;
            $requests->last_date   = $request->date;
            $requests->bloodGroup  = $request->requestBlood_type;
            $requests->level       = $request->level;
            $requests->save();
            if ($requests) {
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => $requests
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => '202',
                'error' => $e->getMessage()
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
