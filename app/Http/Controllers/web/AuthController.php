<?php

namespace App\Http\Controllers\web;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Redirect;
 

 
 
 

class AuthController extends Controller
{
    

   
    public function index()
    {  
        $ip = DB::table('login_attempts')->where(DB::raw("DATE_FORMAT(created_date, '%Y-%m-%d')"), '=', date('Y-m-d'))->where('ip_address', $_SERVER['REMOTE_ADDR'])->get()->toArray();
         if(!empty($ip[0]->attempt) && $ip[0]->attempt > 2){
            return redirect('/lock-account'); 
        } else {
            $salt = substr(md5(time()), 0, 16);
            Session::put('loginsalt', $salt);
            return view('backend.auth.login');  
        }
        return view('backend.auth.login');
    }  
      
    public function changePasswordOneTime(Request $request)
    {
        if ($request->isMethod('post') ) {

        //    $validator = Validator::make($request->all(), ['password' => ['required', 'string', 'min:8', 'confirmed'],]);
         //   $validator->validate();
    
            $authuserid=\Auth::id();
            // $user =  User::find($authuserid);
            // $user->password =  Hash::make($request->new_password);
            // $status=$user->save();

            // $st=User::where('id',$authuserid)->update(['password'=>Hash::make($request->new_password),'first_change_pass'=>2]);

            if($st){
                return redirect('/logout');
            }else{
                return redirect()->route('changePasswordOneTime');
            }
        }
        return view('change_password_one_time');

    } 

    public function locked_account(){
        $ip = DB::table('login_attempts')->where('ip_address', $_SERVER['REMOTE_ADDR'])->get()->toArray();
        
        if(!empty($ip) && $ip[0]->attempt==0){//$ip[0]->ip_address
            return redirect('admin/login')->with( ['type'=>'success','message'=>'You are account is unlock now. Please login']);
         }
         abort(404);

        //  abort('Account Locked. Please contact to admin.');
      return view('auth.lock-account');
    }

     
   
    public function checkSession()
    {
        if (\Auth::check()) {
            return response()->json(['status' => 'active']);
        } else {
            return response()->json(['status' => 'expired']);
        }  
    }
      
   
    public function postLogin(Request $request)
    {
        // dd($request->all());
		$validator = $request->validate([
                'username' => 'required|max:50',
                'password' => 'required',
                 //'captcha' => 'required|captcha',
            ],
               [
                'username.required' => 'username field is required.',
                'password.required' => 'password field is required.',
                //'captcha.captcha'=>'Invalid captcha code.',
            ]
        );
        $req_pass=$request->password;
        $loginsalt = Session::get('loginsalt');
        // dd(Session::get('loginsalt'),$req_pass);
        $org_pass=str_replace($loginsalt,'',$req_pass);
        $decoded_password=base64_decode($org_pass);
        // dd($req_pass,$decoded_password);
        $username=$request->username;
        $credentials=['username'=>$username,'password'=>$decoded_password];
        //$usrpass =hash('sha256', $loginsalt . $user->password);
        // dd(Auth::attempt($credentials));
        if(Auth::guard('web')->attempt($credentials)) { //dd(Auth::user()->getRoleNames()[0]);//dd('IN');
            $user=Auth::user();

           
 			if($user->status!=1){
				 
				 Session::flush();
				 Auth::logout();
				 return Redirect('/');
			}

            $login_apptoken = md5(time() . $user->id);
            DB::table('users')->where('id', $user->id)->update(array('remember_token' => $login_apptoken));
            Session::put('applogintoken', $login_apptoken);
            Session::put('loginuserid', $user->id);
             $ip = DB::table('login_attempts')->where(DB::raw("DATE_FORMAT(created_date, '%Y-%m-%d')"), '=', date('Y-m-d'))->where('ip_address', $_SERVER['REMOTE_ADDR'])->get();
        
            if(!empty($ip[0]->ip_address)){
               $update = DB::table('login_attempts')->where('ip_address', $_SERVER['REMOTE_ADDR'])->update(['attempt' => 0, 'modified_date'=>date('Y-m-d H:i:s')]);
            }
         
            Session::put('user_ip', $_SERVER['REMOTE_ADDR']);
            Session::put('user_agent',$_SERVER['HTTP_USER_AGENT']);
 			
 			$login_history=[
                'user_id'=>$user->id,
                
                'login_at'=>date('Y-m-d H:i:s'),
                'ip_address'=>$_SERVER["REMOTE_ADDR"],
                'user_agent'=>$request->header('User-Agent'),
            ];
            $check_history=DB::table('login_history')->where([
                'user_id'=>$user->id,
                'login_at'=>date('Y-m-d H:i:s'),
                'ip_address'=>$_SERVER["REMOTE_ADDR"],
                'user_agent'=>$request->header('User-Agent'),
            ])->get();
            if(empty($check_history) ){
                DB::table('login_history')->insert($login_history);
            }
            // dd(Auth::user()->getRoleNames()[0]);
			
            if(Auth::user()->getRoleNames()[0]=='ADMIN' ){   
                return redirect()->route('adminDashboard');
            }elseif (Auth::user()->getRoleNames()[0]=='SUPER_ADMIN' ) {
 
                // if($user->first_change_pass === 1){
                //     return redirect()->route('changePasswordOneTime');
                // }
                return redirect()->route('adminDashboard');
                // return redirect('auth/dashboard');
                
            }else {
                return redirect('admin/logout')->with( ['type'=>'warning','message'=>'Oppes! You have not any role! Please contact to Admin.']);
                abort(404);
            }
     
            return redirect('admin/logout')->with( ['type'=>'warning','message'=>'Oppes! You have not any role! Please contact to Admin.']);
            

        }else{

            $data = array(
                "username" => $username,
                "ip_address" => $_SERVER['REMOTE_ADDR'],
                "attempt" => 0,
                'created_date' =>date('Y-m-d'),
            );

            $ip = DB::table('login_attempts')->where(DB::raw("DATE_FORMAT(created_date, '%Y-%m-%d')"), '=', date('Y-m-d'))->where('ip_address', $_SERVER['REMOTE_ADDR'])->get();
             
            if(!empty($ip[0]->ip_address)) {
                $update = DB::table('login_attempts')
                ->where('ip_address', $ip[0]->ip_address)
                ->increment('attempt');
                
            } else {
                DB::table('login_attempts')->insert($data);
            }
           
			return redirect('/admin/login')->with( ['type'=>'warning','message'=>'Oppes! You have entered invalid credentials']);

        }
 
     }
      
   
    // public function postRegistration(Request $request)
    // {  
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);
           
    //     $data = $request->all();
    //     $check = $this->create($data);
         
    //     return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    // }
    
   
    public function dashboard()
    { 
        if(Auth::check()){
            
            // ,compact('location')
            return view('backend.dashboard.dashboard');
        }
        return redirect('/')->with( ['type'=>'warning','message'=>'Opps! You do not have access']);
    }

     
    
 
    public function logout() {
 		 
		$update_login_history=['logout_at'=>date('Y-m-d H:i:s')];
		$login_time=DB::select('select max(login_at) as login_at from login_history where user_id='.Auth::id());
		if(!empty($login_time) && is_array($login_time)){		
			$login_at= $login_time[0]->login_at;
			DB::table('login_history')->where('user_id',Auth::id())->where('login_at','=',$login_at)->update($update_login_history);   
		}
  
        Session::flush();
        Auth::logout();

        return redirect('/admin/login')->with( ['type'=>'success','message'=>'You have successfully logout!']);
    }

    // public function myCaptchaPost(Request $request)
    // {
    //     request()->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'captcha' => 'required|captcha'
    //     ],
    //     ['captcha.captcha'=>'Invalid captcha code.']);
    //     dd("You are here :) .");
    // }
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('math')]);
    }


}