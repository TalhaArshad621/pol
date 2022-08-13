<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class DonatorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $donator = Donator::all('id','name','age','gender','blood_type','number','address','nextSafeDonationDate');
            return response()->json([
                'message' => 'Donator List',
                'code' => 200,
                'data' => $donator
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
            'cnic'    => 'required|unique:donators',
            'gender' => 'required',
            'blood_type' => 'required'
        ]);
        try {
            $donator = new Donator;
            $donator->name = $request->name;
            $donator->address = $request->address;
            $donator->number = $request->contact_num;
            $donator->cnic = $request->cnic;
            $donator->gender = $request->gender;
            $donator->age = $request->age;
            $donator->blood_type = $request->blood_type;
            $donator->save();
            if ($donator) {
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => $donator
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
            $donator = DB::table("donators")->select('id','name','address','number','gender','age','blood_type')->where('cnic',$id)->first();
            return response()->json([
                'message' => 'donator info',
                'code' => 200,
                'data' => $donator
            ]);

        } catch(Exception $e)
        {
            return response()->json([
                'status' => '202',
                'data' => $e
            ]);
        }
    }
    public function showDonator($id)
    {
        try
        {
            $donator = DB::table("donators")->select('*')->where('id',$id)->first();
            return response()->json([
                'data' => $donator
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

    /**
     * Show donator info related to blood donation and preexam.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function donatorInfo($id) 
     {
        try {
            $donator_info = Donator::with(['donations','donations.preExam','donations.locations'])->where('cnic',$id)->first();
            return response()->json([
                'message' => 'Donatorn Info',
                'code'    => 200,
                'data'    => $donator_info
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 202,
                'data' => $e
            ]);
        }
     }
}
