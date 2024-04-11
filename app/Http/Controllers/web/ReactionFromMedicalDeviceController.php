<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReactionFromMedicalDeviceController extends Controller{

    public function consumerMedicalDeviceList(Request $request){

        $data=DB::table('consumerMedicalDeviceForm  as cmd')->select('cmd.*','mae.name as adverse_event_name')->join('m_adverse_event as mae','mae.id','=','cmd.adverse_serious_status')->get();
        // $data=DB::table('consumerMedicalDeviceForm  as cmd')->select('cmd.*')->get();

        //dd($data);
        return view('reactionFromMedicalDevice.consumer_medical_device_list',compact('data'));
    }

    public function voluntryMedicalDeviceList(Request $request){

        // $data=DB::table('voluntryReportingFormSave')->get();
        
        // dd($data);
        return view('reactionFromMedicalDevice.voluntry_medical_device_list');
    }

     

}