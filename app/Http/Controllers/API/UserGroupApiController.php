<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Exception;

class UserGroupApiController extends Controller
{
    public function index(){
        try {
        $roles = Role::all('id', 'name');
        return response()->json([
            "message" => "User Group list",
            "code" => 200,
            "data" => $roles
        ]);
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function store(Request $request){
        DB::beginTransaction();
        $validateData = $request->validate([
            'userGroupname' => 'required',
            'slug' => 'required | unique:roles,name',
            'User' => 'sometimes  |  max:255'
        ]);
        if($validateData){
            try {
            $role = new Role;
            $role->name = $request->userGroupname;
            $role->slug = $request->slug;
            $role->save();
            $role->syncPermissions(
                $request->has('User') ? $request->User : '',
                $request->has('usergroup') ? $request->usergroup : '',
                $request->has('patient') ? $request->patient : '',
                $request->has('request') ? $request->request : '',
                $request->has('bloodbag') ? $request->bloodbag : '',
                $request->has('donator') ? $request->donator : '',
                $request->has('donation') ? $request->donation : '',
                $request->has('donationRequest') ? $request->donationRequest : '',
                $request->has('campaign') ? $request->campaign : '',
                $request->has('report') ? $request->report : '',

            );

            DB::commit();
            return response()->json([
                "message" => "User Group is Added",
                "code" => 200,
                "data" => [
                    "id" => $role->id,
                    'name' => $role->name
                ]
            ]);
            } catch (\Exception $e) {
                DB::rollback();
                throw new HttpException(500, $e->getMessage());
            }
        }
    }

    public function show($id)
    {
        try {
            $userGroup = Role::select('id', 'name', 'slug')->find($id);
            $permissions = $userGroup->permissions('permissions.id')->get();
            $perm = [];
            foreach ($permissions as $key => $p) {
                array_push($perm, $p->id);
            }

            return response()->json([
                "message" => "Found User Group",
                "code" => 200,
                "data" => $userGroup,
                "permissions" => $perm,

            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e,
            ]);
        }
    }

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
                        $request->has('UserEdit') ? $request->UserEdit : '',
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
}
