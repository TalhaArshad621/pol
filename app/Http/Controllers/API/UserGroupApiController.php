<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
}
