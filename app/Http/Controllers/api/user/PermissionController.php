<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function createPermission(Request $request){

        try {
             
            Permission::create([
                'name'=>$request->permission_name,
                'guard_name'=>'api'
            ]);
            return response()->json(['status' => true,'data' =>'Permission Created Successfully.'],200);

        } catch (\Exception $e) {
            return response()->json(['status' => true,'data' =>$e->message],502);
             
        }

    }

    public function updatePermission(Request $request){

        try {
       
            //$permissionArr=$request->permission_name;
            // $permissions=collect($permissionArr)->map(function($permission){
            //     return ['name' => $permission, 'guard_name' => 'api'];
            // });
            //dd($permissions);
            //where('name',$request->permission_name)->where('guard_name',$request->guard_name)
            
            Permission::where('id',$request->permission_id)->update([
                'name'=>$request->permission_name,
                'guard_name'=>$request->guard_name
            ]);
            return response()->json(['status' => true,'data' =>'Permission Updated Successfully.'],200);

        } catch (\Exception $e) {
            return response()->json(['status' => true,'data' =>$e->message],502);
             
        }

    }
    public function showPermission(Request $request){
        try {
          
            $data=Permission::all();
            return response()->json(['status' => true,'data' => $data],200);

        } catch (\Exception $e) {
            return response()->json(['status' => true,'data' =>$e->message],502);
             
        }
    }


}
