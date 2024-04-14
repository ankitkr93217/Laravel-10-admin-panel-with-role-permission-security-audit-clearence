<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\WebUser;
use Hash;


class RoleController extends Controller{


    public function role_list(){
        
        $roles=Role::get();
        // dd($roles);
        return view('backend.userManagement.role.list',compact('roles'));
    }
     
    public function create_role(Request $request){

        if($request->method()=='POST'){
           
            $data = $request->all();// dd($data);
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255', 'unique:roles', 'not_regex:/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/'],
            ]);
            $validator->validate();
            $role = Role::create(['name' => $data['name'],'guard_name'=>$data['guard_name']]);

            if ($role){

                $permissions = Permission::get();
                foreach ($permissions as $p) {
                    if(isset($data[$p->name]) && $data[$p->name] == "on"){
                        $role->givePermissionTo($p);
                    } else {
                        $role->revokePermissionTo($p);
                    }
                }

                return redirect()->route('role_list')->with(['type'=>'success','message'=>"Role created!"]);
            } else {
                return redirect()->route('create_role')->with(['type'=>'danger','message'=>"There has been an error!"]);
            }
            
            
        }

        $permissions = $this->getPermissionsByGroup();
        // echo"<pre>";print_r($permissions);exit;
        return view('backend.userManagement.role.create',['groups' => $permissions]);
    }

    public function edit_role(Request $request){
        
     
        return view('backend.userManagement.role.create');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        // dd($role);
        if($role){
            //Prevent admin role from deletion
            // if($role->id === 1){
            //     return redirect('roles')->with('error',__("Admin role cannot be deleted!"));
            // }

            // $role->delete();
            return redirect('roles')->with('success',__("Role deleted!"));
        } else {
            return redirect('roles')->with('error',__("Role not found!"));
        }
    }
 
    public function getPermissionsByGroup(){

        $permissions = Permission::get();
        $group_arr = [];  
        foreach ($permissions as $permission) {
            if($permission->group_slug !== null && !in_array($permission->group_slug, $group_arr)){
                $group_arr[] = $permission->group_slug;
            }
        }
        foreach ($permissions as $permission) {
            foreach ($group_arr as $group) {
                if($permission->group_slug == $group) {
                    $groups[$permission->group_slug]['name'] = $permission->group_name;
                    $groups[$permission->group_slug]['permissions'][] = $permission->toArray();
                }
            }
        }
        $collection = collect($groups);
        return $collection;
    }

    


}