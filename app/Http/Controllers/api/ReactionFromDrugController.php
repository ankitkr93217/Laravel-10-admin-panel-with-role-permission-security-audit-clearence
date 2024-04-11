<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReactionFromDrugController extends Controller{

    public function ConsumerSideEffectFormSave(Request $request){
        try {
            
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

            $detail_medicine_taken_encode=json_encode($request->medicineTakenDetails);
            
             
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
                'side_effect_start_date'=>$request->side_effect_start_date,
                'side_effect_stop_date'=>$request->side_effect_stop_date,
                'still_side_effect'=>$request->still_side_effect,
                 'side_effect_type'=>$request->side_effect_type,
                'side_effect_desc'=>$request->side_effect_desc,
                'pin_code'=>$request->pin_code,
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>Auth::guard('api')->id(),
            ];
 
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

    public function SeriousAefiCaseNotificationFormSave (Request $request){

        try {
            
            $rule=[
                'address' => 'required|string',
                'address_of_health_facility' => 'required|string',
                'address_of_hospital' => 'required|string',
                'aefi_sign' => 'required|string',
                'age' => 'required|numeric',
                'amc_coordinator_email' => 'required|email',
                'amc_coordinator_name' => 'required|string',
                'amc_coordinator_number' => 'required|numeric',
                'current_status' => 'required|string',
                'date_of_death' => 'required|date',
                'date_of_vacination' => 'required|date',
                'gender' => 'required|string',
                'hospitalization' => 'required|string',
                'hospitalization_date' => 'required|date',
                'hospitalization_time' => 'required|time',
                'name_of_hospital' => 'required|string',
                'parent_name' => 'required|string',
                'patient_name' => 'required|string',
                'pharmacovigilsnce_email' => 'required|email',
                'pharmacovigilsnce_name' => 'required|string',
                'pharmacovigilsnce_number' => 'required|numeric',
                'phone' => 'required|numeric',
                'pin' => 'required|numeric',
                'sympton_date' => 'required|date',
                'time_of_death' => 'required|time',
                'time_of_sympton' => 'required|time',
                'vaccine_dose' => 'required|numeric',
                'vaccine_name' => 'required|string',
            ];
 
            // $validator = Validator::make($request->all(), $rule);
                
            // if ($validator->fails()) {
            //     return response()->json([
            //         "status"=>false,
            //         // "message"=>"required filed are missing",
            //         "error"=>$validator->errors(),
                   
            //         ]
            //     );
            // }

            $data=[
                'patient_name' => $request->patient_name,
                'gender' => $request->gender,
                'age' => $request->age,
                'parent_name' => $request->parent_name,
                'address' => $request->address,
                'pin' => $request->pin,
                'phone' => $request->phone,
                'date_of_vacination' => $request->date_of_vacination,
                'address_of_health_facility' => $request->address_of_health_facility,//21
                'vaccine_name' => $request->vaccine_name,
                'vaccine_dose' => $request->vaccine_dose,
                'sympton_date' => $request->sympton_date,
                'time_of_sympton' => $request->time_of_sympton,
                'address_of_hospital' => $request->address_of_hospital,
                'date_of_death' => $request->date_of_death,
                'hospitalization_date' => $request->hospitalization_date,
                'hospitalization_time' => $request->hospitalization_time,
                'name_of_hospital' => $request->name_of_hospital,
                'time_of_death' => $request->time_of_death,
                'hospitalization' => $request->hospitalization,
                'current_status' => $request->current_status,
                'aefi_sign' => $request->aefi_sign,
                'amc_coordinator_name' => $request->amc_coordinator_name,
                'amc_coordinator_email' => $request->amc_coordinator_email,
                'amc_coordinator_number' => $request->amc_coordinator_number,
                'pharmacovigilsnce_name' => $request->pharmacovigilsnce_name,
                'pharmacovigilsnce_email' => $request->pharmacovigilsnce_email,
                'pharmacovigilsnce_number' => $request->pharmacovigilsnce_number,

     
            ];
 
            $status=DB::table('seriousAefiCaseNotification')->insert($data);
  
            if($status){

                return response()->json(["status"=>true,"message"=>"Serious Aefi Case Notification Form Saved Successfully.",],201);
            }

            
            return response()->json([
                "status"=>false,
                 "message"=>"Serious Aefi Case Notification Form not Saved Successfully. Please try again.",
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


    public function VoluntryReportingFormSave (Request $request){

        try {

            if(!Auth::guard('api')->check()){
                return response()->json(["status"=>false,"message"=>"Please Login first!"]);
            }
            

            $rule=[ 
                    'action_after_reaction' => 'required|string',
                    'age' => 'required|numeric',
                    'date_of_report' => 'required|date',
                    'describe_reaction' => 'required|string',
                    'dob' => 'required|date',
                    'gender' => 'required|string',
                    'investigation_date' => 'required|date',
                    'name' => 'required|string',
                    'outcome' => 'required|string',
                    'reaction_reapeated' => 'required|string',
                    'reaction_serious' => 'Yes',
                    'reaction_start_date' => 'required|date',
                    'reaction_stop_date' => 'required|date',
                    'relevant_investigation' => 'required|string',
                    'relevant_medical' => 'required|string',
                    'rp_address' => 'required|string',
                    'rp_contact' => 'required|numeric',
                    'rp_email' => 'required|email',
                    'rp_name' => 'required|string',
                    'rp_occupation' => 'required|string',
                    'rp_pin' => 'required|numeric',
                    'serious_status' => 'required|string',
                    // 'suspectedMedication' => 'required|string',
                    'weight' => 'required|numeric',
                ];

            // $validator = Validator::make($request->all(), $rule);
                
            // if ($validator->fails()) {
            //     return response()->json([
            //         "status"=>false,
            //         // "message"=>"required filed are missing",
            //         "error"=>$validator->errors(),
                   
            //         ]
            //     );
            // }

            // concomitant_medicine_image
            // medicine_image

            $suspectedMedication_arr=$request->suspectedMedication;
            if(!empty($suspectedMedication_arr)){
                foreach ($suspectedMedication_arr as $k => $v) {
                    // echo $k;exit;

                    
                      
                    $medicine_image = $v['medicine_image'];$imageName='';$imageData='';
                    if(!empty($medicine_image)){
                        $imageData = str_replace('data:image/jpeg;base64,', '', $medicine_image);
                        $imageData = str_replace(' ', '+', $imageData);
                        $imageName = Auth::guard('api')->id().'-'.rand(11,99).'-'.time().'.jpeg';
                        // \Storage::disk('public')->put($imageName, base64_decode($imageData));
                        \Storage::disk('public_drug_voluntry')->put($imageName, base64_decode($imageData));
                        $suspectedMedication_arr[$k]['medicine_image']=$imageName;
                    }else{
                        $suspectedMedication_arr[$k]['medicine_image']=NULL;
                    }
                  
                     
                    $concomitant_medicine_image = $v['concomitant_medicine_image'];$imageName='';$imageData='';
                    if(!empty($concomitant_medicine_image)){
                        $imageData = str_replace('data:image/jpeg;base64,', '', $concomitant_medicine_image);
                        $imageData = str_replace(' ', '+', $imageData);
                        // $imageName = Auth::guard('api')->id().'-'.time().'.jpeg';
                        $imageName = Auth::guard('api')->id().'-'.rand(11,99).'-'.time().'.jpeg';

                        // \Storage::disk('public')->put($imageName, base64_decode($imageData));
                        \Storage::disk('public_drug_voluntry')->put($imageName, base64_decode($imageData));
                        $suspectedMedication_arr[$k]['concomitant_medicine_image']=$imageName;
                    }else{
                        $suspectedMedication_arr[$k]['concomitant_medicine_image']=NULL;
                    }
                    
                    
                }
            }

            $data=[
                   
                    'name' => $request->name,
                    'age' => $request->age,
                    'dob' => date('Y-m-d',strtotime($request->dob)),
                    'weight' => $request->weight,
                    'gender' => $request->gender,

                    'reaction_start_date' => date('Y-m-d',strtotime($request->reaction_start_date)),
                    'reaction_stop_date' =>  date('Y-m-d',strtotime($request->reaction_stop_date)),
                    'describe_reaction' => $request->describe_reaction,

                    'suspectedMedication' => json_encode($suspectedMedication_arr),

                    'action_after_reaction' => $request->action_after_reaction,

                    //reporter
                    'rp_address' => $request->rp_address,
                    'rp_contact' => $request->rp_contact,
                    'rp_email' => $request->rp_email,
                    'rp_name' => $request->rp_name,
                    'rp_occupation' => $request->rp_occupation,
                    'rp_pin' => $request->reporter_pin,
                    'date_of_report' =>  date('Y-m-d',strtotime($request->date_of_report)),

                    'reaction_reapeated' => $request->reaction_reapeated,//reaction_reappeated=reaction_reapeated
 
                    'relevant_investigation' => $request->relevant_investigation,
                    'investigation_date' =>  date('Y-m-d',strtotime($request->investigation_date)),
                    'relevant_medical_history' => $request->relevant_medical_history ,//relevant_medical=relevant_medical_history

                    'reaction_serious' => $request->reaction_serious,

                    'outcome' => $request->outcome,

                    'serious_status' => $request->serious_status,
                    'additional_info' => $request->additional_info,
                    
                    'created_by'=>Auth::guard('api')->id(),
                    
                ];
 
            $status=DB::table('voluntryReportingFormSave')->insert($data);
  
            if($status){

                return response()->json(["status"=>true,"message"=>"Voluntry Reporting Form Saved Successfully.",],201);
            }

            
            return response()->json([
                "status"=>false,
                 "message"=>"Voluntry Reporting Form not Saved Successfully. Please try again.",
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

    public function getAdverseEventList (Request $request){

        try {

            $data=DB::table('m_adverse_event')->get();
            return response()->json(["status"=>true,"data"=>$data,],200);

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

    public function getMedicineAdviserList (Request $request){

        try {

            $data=DB::table('m_medicine_adviser')->get();
            return response()->json(["status"=>true,"data"=>$data,],200);

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

    // public function ConsumerMedicalDeviceFormSave (Request $request){

    //     try {

    //        $rule=[ 
    //         'adverse_death_date' => 'required|string',
    //         'adverse_event_type' => 'required|string',
    //         'adverse_serious_status' => 'required|string',
    //         'date_of_adverse_event' => 'required|date',
    //         'date_of_birth' => 'required|date',
    //         'date_of_explant' => 'required|date',
    //         'date_of_implant' => 'required|date',
    //         'device_Name' => 'required|string',
    //         'device_use_after_incident' =>'required',
    //         'gender' => 'required|string',
    //         'impoter_address' => 'required|string',
    //         'impoter_name' => 'required|string',
    //         'location_of_event' => 'O',
    //         'lot_number' => 'required|string',
    //         'manufacture_address' => 'required|string',
    //         'maufacture_name' => 'required|string',
    //         'medical_history' => 'required|string',
    //         'model_number' => 'required|string',
    //         'other_device_Details' => 'required|string',
    //         'other_device_name' => 'required|string',
    //         'other_device_use' => 'Y',
    //         'other_locatin' => 'required|string',
    //         'other_medical_history' => 'required|string',
    //         'patient_hospital_id' => 'required|string',
    //         'patient_initial' => 'required|string',
    //         'product_problem' => 'required|string',
    //         'report_date' => 'required|string',
    //         'reporter_address' => 'required|string',
    //         'rp_email' => 'required|string',
    //         'rp_mobile' => 'required|string',
    //         'rp_name' => 'required|string',
    //         'rp_occupation' => 'required|string',
    //         'serial_number' => 'required|string',
    //         'type_of_report' => 'PP',
    //         'weight' => 'required|string',
    //        ];

    //         // $validator = Validator::make($request->all(), $rule);
                
    //         // if ($validator->fails()) {
    //         //     return response()->json([
    //         //         "status"=>false,
    //         //         // "message"=>"required filed are missing",
    //         //         "error"=>$validator->errors(),
                   
    //         //         ]
    //         //     );
    //         // }

    //         $data=[ 
 
    //             'report_date' => $request->report_date,
    //             'patient_hospital_id' => $request->patient_hospital_id,
    //             'patient_initial' => $request->patient_initial,
    //             'gender' => $request->gender,
    //             'date_of_birth' => $request->date_of_birth,

    //             'weight' => $request->weight,
    //             'other_medical_history' => $request->other_medical_history,

    //             'maufacture_name' => $request->maufacture_name,
    //             'manufacture_address' => $request->manufacture_address,
    //             'impoter_name' => $request->impoter_name,
    //             'impoter_address' => $request->impoter_address,
    //             'model_number' => $request->model_number,

    //             'date_of_adverse_event' => $request->date_of_adverse_event,
    //             'product_problem' => $request->product_problem,
    //             'use_date_of_implantOrDevice' => $request->use_date_of_implantOrDevice,//date_of_implant=use_date_of_implantOrDevice
    //             'use_date_of_explantOrDevice' => $request->use_date_of_explantOrDevice,//date_of_explant=use_date_of_explantOrDevice

    //             'location_of_event' =>  $request->location_of_event,
    //             'other_location' => $request->other_locatin,//other_locatin=other_location
    //             'device_use_after_incident' => $request->device_use_after_incident,

    //             'adverse_event_type' =>  $request->adverse_event_type,//have to share api to Ayush
    //             'adverse_death_date' => $request->adverse_death_date,

    //             'rp_address' => $request->rp_address,
    //             'rp_contact' => $request->rp_contact,
    //             'rp_email' => $request->rp_email,
    //             'rp_name' => $request->rp_name,
    //             'rp_occupation' => $request->rp_occupation,

    //             //below code verify
    //             'adverse_serious_status' => $request->adverse_serious_status,
    //             'device_Name' => $request->device_Name,
    //             'lot_number' => $request->lot_number,
    //             'medical_history' => $request->medical_history,
              
    //             'other_device_Details' => $request->other_device_Details,
    //             'other_device_name' => $request->other_device_name,
    //             'other_device_use' => $request->other_device_use,
               
    //             'serial_number' => $request->serial_number,
    //             'type_of_report' =>$request->type_of_report,
               
               
    //         ]; 

    //         $status=DB::table('consumerMedicalDeviceForm')->insert($data);
  
    //         if($status){

    //             return response()->json(["status"=>true,"message"=>"Consumer Medical Device Form Saved Successfully.",],201);
    //         }

            
    //         return response()->json([
    //             "status"=>false,
    //              "message"=>"Consumer Medical Device Form not Saved Successfully. Please try again.",
    //              ],501
    //         );

             


    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         // dd($th->getMessage());
    //         return response()->json([
    //             "status"=>false,
    //              "message"=>$th->getMessage(),
    //              ],502
    //         );
    //     }


    // }


}