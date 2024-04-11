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


class UserController extends Controller{

    public function create_user(Request $request){
        
       if($request->method()=='GET'){
            // $roles=Role::where('name','ADMIN')->get()->toArray();
            $roles=Role::where('name','!=','SUPER_ADMIN')->get()->toArray();
            return view('backend.userManagement.user.create_user',compact('roles'));
       }
        
        $data = $request->all();
        $auth_user=Auth::guard('web')->user();
        

           $validator = Validator::make($request->all(),[

               'name' => 'required|min:2',
               'email' => 'required|max:255',
               'number' => 'required|min:10|max:10',
               'password' => ['required', 'string', 'min:8'],
               'username' => 'required|min:5|unique:users,username',
               'role_id' => 'required|integer',
            ],
           [
               'username.required' => 'username field is required.',
               'password.required' => 'password field is required.',
               'loc_id.required' => 'Location is required.',
               'role_id.required' => 'Role is required.',
            ]);
           $validator->validate();

        //if($user->getRoleNames()[0]=='SUPER_ADMIN') {}
 
       $user = WebUser::create([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
           'cell_number' => $data['cell_number'],
           'username' =>  $data['username'],
            'parent_id' => $auth_user->id,
            'gender' =>  $data['gender'],
            'age' => $data['age'],
       ]);
       

       if ($user){

           if(isset($data['role_id']) && $data['role_id'] != ""){
               $role = Role::find($data['role_id']);
                if($role){
                    setPermissionsTeamId($user->id);
                   $user->assignRole($role->name);
                   //$user->assignRole($role);
               }
           }

           return redirect('user/user_list')->with(['type'=>'success','message'=>"User created!"]);
       } else {
           return redirect()->back()->with(['type'=>'danger','message'=>"User not created.Please Try again."]);
       }

       
    }

    public function user_list(Request $request){
        $users= \DB::table('users as  u')->join('model_has_roles as mhr','u.id','=','mhr.model_id')
        ->join('roles as r','mhr.role_id','=','r.id')
        ->whereNotIn('r.name',['SUPER_ADMIN'])
        ->orderBy('u.id','desc')
        ->get(['u.id','u.name','u.username','u.email','u.status','r.name as r_name','u.created_at','number','u.gender'])->toArray();
        return view('backend.userManagement.user.list',compact('users'));
    }

    public function user_edit(Request $request,$id){
        
        if($request->method()=='GET'){

            // $user=DB::table('users')->where('id',$id)->get()->toArray();
            $user= \DB::table('users as  u')->join('model_has_roles as mhr','u.id','=','mhr.model_id')
            ->join('roles as r','mhr.role_id','=','r.id')
            ->where('u.id',$id)
            ->get(['u.id','u.name','u.username','u.email','u.status','r.name as r_name','u.created_at','number','u.gender'])->toArray();
           
            $roles=Role::whereNotIn('name',['SUPER_ADMIN'])->get();
            // dd($roles);
            return view('backend.userManagement.user.show_user',compact('user','roles'));
       }
         return view('backend.userManagement.user.list',compact('users'));
    }


}