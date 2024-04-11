<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\ApiUser;


class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request){
        // dd('dddddd');
        // return 'xxx';
        // $credentials = $request->only('email', 'password');
        // $credentials=['username'=>$request->username,'password'=>$request->password];
        $credentials=['username'=>$request->username,'password'=>$request->password];
        // if ($token = Auth::guard('api')->attempt($credentials)) {
        if ($token = Auth::guard('api')->attempt($credentials)) {
            
           
            // $user=Auth::guard('api')->user();
            $user=auth('api')->user();
            // dd($user->roles->pluck('name')->toArray());
             //  ->with('roles')
            // $role = $user->roles->pluck('name')[0];
            // $permission = $user->getAllPermissions();
            
            return response()->json([
                // 'role'=>$role,
                'user'=>$user,
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        }
        return response()->json(['error' => 'You have entered invalid credentials!'], 401);

        // return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function publicRegistration(Request $request){

        try {
            
            $rule=[
                // 'username' => 'required|min:5|unique:users,username',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'cell_number' => 'required|numeric|unique:users,cell_number',//|min:10|max:10
                'email' => 'required|email',
                'password'=>['required', 'string', 'min:8'],

            ];

            $validator = Validator::make($request->all(), $rule);
                
            if ($validator->fails()) {
                return response()->json([
                    "status"=>false,
                    // "msg"=>"required filed are missing",
                    "error"=>$validator->errors(),
                   
                    ]
                );
            }

            $data=[
                'username'=>$request->username,
                'name'=>$request->firstname.' '.$request->lastname,
                'cell_number'=>$request->cell_number,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                // 'created_at'=>date('Y-m-d H:i:s'),
                // 'updated_at'=>date('Y-m-d H:i:s'),
            ];
            $user=User::create($data);
 
            if($user){

                $role = Role::where('name','user')->get()->toArray();
                 if(!empty($role)){
                    //  $user->assignRole($role[0]['name'],9);
                     $user->assignRole($role[0]['name']);

                    // $user->assignRole($role[0]['name'])->teams()->attach($role[0]['team_id']);
                }

                return response()->json(["status"=>true,"message"=>"Registration Successful.",],201);
            }

            return response()->json([
                "status"=>false,
                 "message"=>"Registration not Successful. Please try again.",
                 ],501
            );

             


        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function me()
    {
        return response()->json(\Auth::user());

       // return response()->json($this->guard('api')->user());
    }

    
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function test()
    {
        return response()->json('messsssssssssssssssss');

       // return response()->json($this->guard('api')->user());
    }





    
}
