<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Auth;

//for excel
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportState;
use App\Exports\UsersExport;

class UserController extends Controller
{

    public function asignRoleToUser() 
    {
        try {
            $user_id=$request->user_id;
            $role_id=$request->role_id;
            

           
        } catch (\Exception $e) {
            

        }

    }


    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request) 
    {
       

        $file=$request->file('file');
        //->originalName;
       //dd($file);
       //
        Excel::import(new ImportState,$file);
        
        return redirect('/')->with('success', 'Imported Successfully!');
    }
}
