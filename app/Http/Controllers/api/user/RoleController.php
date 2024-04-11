<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Auth;
// use Exception;

class RoleController extends Controller
{
    public function createRole(Request $request){
        try {
           //$a
            $status=Role::create([
                'name'=>$request->role_name,
                'team_id'=>Auth::id(),
                'guard_name'=>$request->guard_name
            ]);

            if ($status) {
                return response()->json(['status' => true,'data' =>'Role Created Successfully.'],200);
            }
            return response()->json(['status' => true,'data' =>'Something happening wrong.Please try again.'],200);
            
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => true,'data' =>$e->getMessage()],502);
             
        }

    }

    public function updateRole(Request $request){
        try {
            //('name',$request->role_name)->where('guard_name',$request->guard_name)
            Role::where('id',$request->role_id)->update([
                'name'=>$request->role_name,
                'team_id'=>Auth::id(),
                'guard_name'=>$request->guard_name
            ]);
            return response()->json(['status' => true,'data' =>'Role Updated Successfully.'],502);

        } catch (\Exception $e) {
            return response()->json(['status' => true,'data' =>$e->getMessage()],200);
            
        }

    }
    public function showRole(Request $request){
        try {
            //code...
            $data=Role::all();
            return response()->json(['status' => true,'data' => $data],200);

        } catch (\Exception $e) {
            return response()->json(['status' => true,'data' =>$e->getMessage()],502);
             
        }
    }
}
