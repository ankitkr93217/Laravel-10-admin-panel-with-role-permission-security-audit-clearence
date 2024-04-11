<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\UploadedFile;


class AdrReportController extends Controller{

    public function AdrReportFormSave (Request $request){

        try {

            if(!Auth::guard('api')->check()){
                return response()->json(["status"=>false,"message"=>"Please Login first!"]);
            }
            
          
            // dd($medicineTakenDetails_arr);

           
            // $imageDataArray = $request->medicineTakenDetails[0]['medicine_image'];
            // $imageData = str_replace('data:image/jpeg;base64,', '', $imageDataArray);
            // $imageData = str_replace(' ', '+', $imageData);
            // $imageName = time().'.jpeg';
            // // \Storage::disk('public')->put($imageName, base64_decode($imageData));
            // \Storage::disk('public_drug_consumer')->put($imageName, base64_decode($imageData));
            // echo $imageName;exit;
         
              
            $rule=[
                'patient_initials' => 'required',
                'age' => 'required|numeric',
                'weight' => 'required|numeric',
                'gender' => 'required|string',//|min:10|max:10
                // 'reason_for_medicine' => 'required|string',
                // 'medicine_adviser'=>'required|numeric',
                // 'rp_name' => 'required|string',
                // 'rp_address' => 'required|string',
                // 'rp_number' => 'required|numeric',
                // 'rp_email' => 'required|email',
                // 'medicine_name' => 'required',
                // 'medicine_taken_per_day' => 'required',
                // 'medicine_exp_date' => 'required',
                // 'medicine_start_date' => 'required',
                // 'medicine_stop_date' => 'required',
                // 'dosage_from' => 'required|string',
                // 'side_effect_start_date' => 'required|string',
                // 'side_effect_stop_date' => 'required|string',
                // 'still_side_effect' => 'required|string',
                // 'side_effect_type' => 'required|string',
                // 'side_effect_desc' => 'required|string',

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

            // $medicine_name_arr=$request->medicine_name;
            // $medicine_taken_per_day_arr=$request->medicine_taken_per_day;
            // $medicine_exp_date_arr=$request->medicine_exp_date;
            // $medicine_start_date_arr=$request->medicine_start_date;
            // $medicine_stop_date_arr=$request->medicine_stop_date;
            // $detail_medicine_taken=[];

            // foreach($medicine_name_arr as $k=>$v){

            //     $tmp_arr=[];
            //     $tmp_arr['medicine_name']=$v;
            //     $tmp_arr['medicine_taken_per_day']=$medicine_taken_per_day_arr[$k];
            //     $tmp_arr['medicine_exp_date']=$medicine_exp_date_arr[$k];
            //     $tmp_arr['medicine_start_date']=$medicine_start_date_arr[$k];
            //     $tmp_arr['medicine_stop_date']=$medicine_stop_date_arr[$k];

            //     array_push($detail_medicine_taken,$tmp_arr);
            // }
            // $detail_medicine_taken_encode=json_encode($detail_medicine_taken);
            


              // $image =$request->medicineTakenDetails[0]['medicine_image']; 
              $medicineTakenDetails_arr=$request->medicineTakenDetails;
              if(!empty($medicineTakenDetails_arr)){
                  foreach ($medicineTakenDetails_arr as $k => $v) {
                      // echo $k;exit;
                        
                      $medicine_image = $v['medicine_image'];
                      $imageData = str_replace('data:image/jpeg;base64,', '', $medicine_image);
                      $imageData = str_replace(' ', '+', $imageData);
                      $imageName = Auth::guard('api')->id().'-'.time().'.jpeg';
                      // \Storage::disk('public')->put($imageName, base64_decode($imageData));
                      \Storage::disk('public_drug_consumer')->put($imageName, base64_decode($imageData));
                      $medicineTakenDetails_arr[$k]['medicine_image']=$imageName;
                      // $v['medicine_image']=$imageName;
                      
                      
                  }
              }
            // $detail_medicine_taken_encode=json_encode($request->medicineTakenDetails);
            $detail_medicine_taken_encode=json_encode($medicineTakenDetails_arr);

            
             
            $data=[
                'patient_initials'=>$request->patient_initials,
                'age'=>$request->age,
                'weight'=>$request->weight,
                'gender'=>$request->gender,
                'reason_for_medicine'=>$request->reason_for_medicine,
                'medicine_adviser'=>$request->medicine_adviser,
                'rp_name'=>$request->rp_name,
                'rp_address'=>$request->rp_address,
                'rp_number'=>$request->rp_number,
                'rp_email'=>$request->rp_email,
                'medicine_taken_details'=>$detail_medicine_taken_encode,
                'dosage_from'=>$request->dosage_from,
                'side_effect_start_date'=>date('Y-m-d',strtotime($request->side_effect_start_date)),
                'side_effect_stop_date'=>date('Y-m-d',strtotime($request->side_effect_stop_date)),
                'still_side_effect'=>$request->still_side_effect,
                'side_effect_type'=>$request->side_effect_type,
                'side_effect_type_other'=>$request->side_effect_type_other,
                'side_effect_desc'=>$request->side_effect_desc,
                'pin_code'=>$request->pin_code,
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>Auth::guard('api')->id(),
                
            ];
            // dd($data);
 
            $status=DB::table('adr_report')->insert($data);
  
            if($status){
                return response()->json(["status"=>true,"message"=>"Medicine Side Effect Reporting Form Saved Successfully.",],201);
            }

            return response()->json([
                "status"=>false,
                 "message"=>"Medicine Side Effect Reporting Form not Save Successful. Please try again.",
                 ],501
            );

             


        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return response()->json([
                "status"=>false,
                 "message"=>$th->getMessage(),
                 ],502
            );
        }


    }
}