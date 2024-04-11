<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReactionFromDrugController extends Controller{

    public function consumerSideEffectList(Request $request){
        $data=DB::table('adr_report as adr')->select('adr.*','mda.name as medicine_adviser')->join('m_medicine_adviser as mda','mda.id','=','adr.medicine_adviser')->orderBy('adr.id','desc')->get();
        
        // dd($data);
        return view('reactionFromDrug.consumer_side_effect_list',compact('data'));
    }

    public function voluntryReportingList(Request $request){

        $data=DB::table('voluntryReportingFormSave')->orderBy('id','desc')->get();
        
        // dd($data);
        return view('reactionFromDrug.voluntry_reporting_list',compact('data'));
    }

     

}