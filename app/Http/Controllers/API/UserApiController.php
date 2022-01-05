<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{
    public function index(){
        try{
            $users = User::all('id','name','email');
            return response()->json([
                'message' => 'User List',
                'code' => 200,
                'data' => $users
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => $e
            ]);
        }
    }

    public function show($id){
        $user = DB::table('users')
            ->leftjoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftjoin('roles', 'model_has_roles.role_id', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'roles.id as role_id', 'roles.name as role_name')
            ->where('users.id', $id)
            ->first();
        if ($user) {
            return response()->json([
                "message" => "Got User info",
                "code" => 200,
                "data" => $user
            ]);
        } else {
            return response()->json([
                "message" => "User Not Found",
                "code" => 200,
            ]);
        }
    }

    public function store(Request $request){
        DB::beginTransaction();
        $validateData = $request->validate([
            'name' => 'required',
            'password' => 'required|string',
            'email' => 'required|email|unique:users|string'
        ]);
        try {
            $user = new User;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
            $user->assignRole($request->roles);
            if ($user) {
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => $user
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

    public function destroy($id){
        DB::beginTransaction();
        try {
            $user = User::find($id);

            $roles = $user->getRoleNames();

            if ($user->hasAnyRole($roles)) {
                $user->revokeRole($roles);
            }

            $user->delete();
            if ($user) {
                DB::commit();
                return response()->json([
                    "message" => "User Deleted",
                    "code" => 200,
                    "data" => [
                        "id" => $user->id,
                        "name" => $user->name
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
