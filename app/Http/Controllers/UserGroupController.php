<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPermission      = Permission::user()->get();
        $userGroupPermission = Permission::userGroup()->get();
        $patient             = Permission::patient()->get();
        $hospitalRequest     = Permission::hospitalRequest()->get();
        $bloodBag            = Permission::bloodBag()->get();
        $donator             = Permission::donator()->get();
        $donation            = Permission::donation()->get();
        $donationRequest     = Permission::donationRequest()->get();
        $campaign            = Permission::campaign()->get();
        $report              = Permission::report()->get();


        return view('usergroup.index', compact(
            'userPermission',
            'userGroupPermission',
            'patient',
            'hospitalRequest',
            'bloodBag',
            'donator',
            'donation',
            'donationRequest',
            'campaign',
            'report'
        ));
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
        DB::beginTransaction();
        try {
            try {
                $validatedData = $request->validate([
                    'userGroupEditName' => 'required | max:255',
                    'userGroupEditSlug' => 'required |unique:roles,name,' . $request->userGroupEditID,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    "message" => $e->getMessage(),
                    "issue" => "incorrect Input",
                ]);
            }
            try {
                if ($validatedData) {
                    $userGroup = Role::find($request->userGroupEditID);
                    $userGroup->update([
                        "name" => $request->userGroupEditName,
                        "slug" => $request->userGroupEditSlug
                    ]);
                    $userGroup->syncPermissions([
                        $request->has('patientEdit') ? $request->patientEdit : '',
                        $request->has('requestEdit') ? $request->requestEdit : '',
                        $request->has('bloodbagEdit') ? $request->bloodbagEdit : '',
                        $request->has('donatorEdit') ? $request->donatorEdit : '',
                        $request->has('donationEdit') ? $request->donationEdit : '',
                        $request->has('donationRequestEdit') ? $request->donationRequestEdit : '',
                        $request->has('usergroupEdit') ? $request->usergroupEdit : '',
                        $request->has('campaignEdit') ? $request->campaignEdit : '',
                        $request->has('reportEdit') ? $request->reportEdit : '',
                    ]);
                    if ($userGroup) {
                        DB::commit();
                        return response()->json([
                            "message" => "User Group Information Updated",
                            "code" => 200,
                            "data" => [
                                "id" => $userGroup->id,
                                'name' => $userGroup->name
                            ]
                        ]);
                    }
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json([
                    "message" => $e->getMessage(),
                    "issue" => "SQL Error",

                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "message" => $e->getMessage(),
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
