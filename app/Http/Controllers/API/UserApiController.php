<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function getUsers(){
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

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $user = new User;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
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
}
