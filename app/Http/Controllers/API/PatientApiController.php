<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Patient;
use Exception;

class PatientApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $patient = Patient::all('id','name','age','gender','blood_type','contact_num','address');
            return response()->json([
                'message' => 'Patient List',
                'code' => 200,
                'data' => $patient
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
            'name' => 'required',
            'age' => 'required',
            'address' => 'required',
            'contact_num' => 'required',
            'gender' => 'required',
            'blood_type' => 'required'
        ]);
        try {
            $patient = new Patient;
            $patient->name = $request->name;
            $patient->address = $request->address;
            $patient->contact_num = $request->contact_num;
            $patient->gender = $request->gender;
            $patient->age = $request->age;
            $patient->blood_type = $request->blood_type;
            $patient->save();
            if ($patient) {
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => $patient
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
            $patient = Patient::select('id','name','age','gender','blood_type','contact_num','address')->find($id);
            return response()->json([
                'message' => 'Patient info',
                'code' => 200,
                'data' => $patient
            ]);

        } catch(Exception $e)
        {
            return response()->json([
                'status' => '202',
                'data' => $e
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
            'editAge' => 'required',
            'editAddress' => 'required',
            'editContact_num' => 'required',
            'editGender' => 'required',
            'editblood_type' => 'required',
        ]);
        try {
            $patient = Patient::find($id);
            $patient->name = $request->editName;
            $patient->address = $request->editAddress;
            $patient->contact_num = $request->editContact_num;
            $patient->gender = $request->editGender;
            $patient->age = $request->editAge;
            $patient->blood_type = $request->editblood_type;
            $patient->save();
            if ($patient) {
                DB::commit();
                return response()->json([
                    'message' => 'Patient updated',
                    'status' => 200,
                    'data' => $patient
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $patient = Patient::find($id);
            $patient->delete();
            if ($patient) {
                DB::commit();
                return response()->json([
                    "message" => "Patient Deleted",
                    "code" => 200,
                    "data" => [
                        "id" => $patient->id,
                        "name" => $patient->name
                    ]
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "message" => $e,
            ]);
        }
    }
}
