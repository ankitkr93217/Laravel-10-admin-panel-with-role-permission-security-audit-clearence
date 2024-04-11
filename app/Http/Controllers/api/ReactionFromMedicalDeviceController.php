<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReactionFromMedicalDeviceController extends Controller{

public $DRTOKEN,$MDTOKEN;
    public function __constructor(){

    }

    public function ConsumerMedicalDeviceFormSave (Request $request){

        try {

           $rule=[ 
            'adverse_death_date' => 'required|string',
            'adverse_event_type' => 'required|string',
            'adverse_serious_status' => 'required|numeric',
            'date_of_adverse_event' => 'required|date',
            'date_of_birth' => 'required|date',
            'date_of_explant' => 'required|date',
            'date_of_implant' => 'required|date',
            'device_Name' => 'required|string',
            'device_use_after_incident' =>'required',
            'gender' => 'required|string',
            'impoter_address' => 'required|string',
            'impoter_name' => 'required|string',
            'location_of_event' => 'O',
            'lot_number' => 'required|string',
            'manufacture_address' => 'required|string',
            'maufacture_name' => 'required|string',
            'medical_history' => 'required|string',
            'model_number' => 'required|string',
            'other_device_Details' => 'required|string',
            'other_device_name' => 'required|string',
            'other_device_use' => 'Y',
            'other_locatin' => 'required|string',
            'other_medical_history' => 'required|string',
            'patient_hospital_id' => 'required|string',
            'patient_initial' => 'required|string',
            'product_problem' => 'required|string',
            'report_date' => 'required|string',
            'reporter_address' => 'required|string',
            'rp_email' => 'required|string',
            'rp_mobile' => 'required|string',
            'rp_name' => 'required|string',
            'rp_occupation' => 'required|string',
            'serial_number' => 'required|string',
            'type_of_report' => 'PP',
            'weight' => 'required|string',
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

             
            $medical_image = $request->medical_image;$imageName='';$imageData='';
            if(!empty($medical_image)){
                $imageData = str_replace('data:image/jpeg;base64,', '', $medical_image);
                $imageData = str_replace(' ', '+', $imageData);
                // $imageName = Auth::guard('api')->id().'-'.time().'.jpeg';
                $imageName = Auth::guard('api')->id().'-'.rand(11,99).'-'.time().'.jpeg';

                // \Storage::disk('public')->put($imageName, base64_decode($imageData));
                \Storage::disk('public_device_consumer')->put($imageName, base64_decode($imageData));
                 $data['medical_image']=$imageName;
            }else{
                $data['medical_image']=NULL;
            }

            $data=[ 
 
                'report_date' => date('Y-m-d',strtotime($request->report_date)),

                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'age' => $request->age,
                'pin' => $request->pin,
                'device_return' => $request->device_return,

                'rp_state' => $request->rp_state,
                'rp_district' => $request->rp_district,
                'rp_pincode' => $request->rp_pincode,
                'how_patient_know' => $request->how_patient_know,
                'member_name_other' => $request->member_name_other,
                


                // 'age' => $request->age,
                // 'pin' => $request->pin,
                


                'patient_hospital_id' => $request->patient_hospital_id,
                'patient_initial' => $request->patient_initial,
                'gender' => $request->gender,
                'date_of_birth' => date('Y-m-d',strtotime($request->date_of_birth)),

                'weight' => $request->weight,
                'other_medical_history' => $request->other_medical_history,

                'maufacture_name' => $request->maufacture_name,
                'manufacture_address' => $request->manufacture_address,
                'impoter_name' => $request->impoter_name,
                'impoter_address' => $request->impoter_address,
                'model_number' => $request->model_number,

                'date_of_adverse_event' => date('Y-m-d',strtotime($request->date_of_adverse_event)),
                'product_problem' => $request->product_problem,
                'use_date_of_implantOrDevice' => $request->use_date_of_implantOrDevice,//date_of_implant=use_date_of_implantOrDevice
                'use_date_of_explantOrDevice' => $request->use_date_of_explantOrDevice,//date_of_explant=use_date_of_explantOrDevice

                'location_of_event' =>  $request->location_of_event,
                'other_location' => $request->other_locatin,//other_locatin=other_location
                'device_use_after_incident' => $request->device_use_after_incident,

                'adverse_serious_status' => $request->adverse_serious_status,
                'adverse_event_type' =>  $request->adverse_event_type,//have to share api to Ayush
                'adverse_death_date' => date('Y-m-d',strtotime($request->adverse_death_date)),

                'rp_address' => $request->rp_address,
                'rp_contact' => $request->rp_contact,
                'rp_email' => $request->rp_email,
                'rp_name' => $request->rp_name,
                'rp_occupation' => $request->rp_occupation,

                //below code verify
               
                'device_Name' => $request->device_Name,
                'lot_number' => $request->lot_number,
                'medical_history' => $request->medical_history,
              
                'other_device_Details' => $request->other_device_Details,
                'other_device_name' => $request->other_device_name,
                'other_device_use' => $request->other_device_use,
               
                'serial_number' => $request->serial_number,
                'type_of_report' =>$request->type_of_report,
                'created_by'=>Auth::guard('api')->id(),
               
               
            ]; 

            $status=DB::table('consumerMedicalDeviceForm')->insert($data);
  
            if($status){

                return response()->json(["status"=>true,"message"=>"Consumer Medical Device Form Saved Successfully.",],201);
            }

            
            return response()->json([
                "status"=>false,
                 "message"=>"Consumer Medical Device Form not Saved Successfully. Please try again.",
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

    public function VoluntryMedicalDeviceFormSave (Request $request){

        try {

           $rule=[ 
            'report_date' =>'required|date',
            'report_type' => 'required|date',
            'refrence_report' =>  $request->refrence_report,

            'rp_type' =>  $request->rp_type,//rp=reporter
            'rp_name' =>  $request->rp_name,
            'rp_number' =>  $request->rp_number,
            'rp_address' =>  $request->rp_address,
            'rp_email' =>  $request->rp_email,

            'medical_device' =>  $request->medical_device,//have to share api

            'vitro_diagnostic' =>  $request->vitro_diagnostic,//have to share api

            'medical_equipments' =>  $request->medical_equipments,//have to share api

            'device_name' =>  $request->device_name,

            'manufacture_name' =>  $request->manufacture_name,
            'manufacture_address' =>  $request->manufacture_address,
            'importer_name' =>  $request->importer_name,

            'importer_address' =>  $request->importer_address,
            'distributor_name' =>  $request->distributor_name,
            'distributor_address' =>  $request->distributor_address,

            
            'device_notifiedOrRegulated' =>  $request->device_notifiedOrRegulated,//device_regulated_india=device_notifiedOrRegulated
            'device_risk_class' =>  $request->device_risk_class,//device_risk_mdr=device_risk_class
            'license_no' =>  $request->license_no,
            // 'catalogue_name' =>  $request->catalogue_name,
            'catalogue_no' =>  $request->catalogue_no,

            'model_no' =>  $request->model_no,
            'lot_no' =>  $request->lot_no,
            'serial_number' =>  $request->serial_number,
            'software_version' =>  $request->software_version,

            'associated_device' =>  $request->associated_device,
            'nomenclature_code' =>  $request->nomenclature_code,
            'udi_no' =>  $request->udi_no,
            'installation_date' =>  $request->installation_date,

            'expire_date' =>  $request->expire_date,
            'last_maintenance_date' =>  $request->last_maintenance_date,
            'last_cailbration_date' =>  $request->last_cailbration_date,
            'manufacturing_year' =>  $request->manufacturing_year,

            'machine_use_duration' =>  $request->machine_use_duration,//long_machine_use=machine_use_duration
            'device_availability_forEval' =>  $request->device_availability_forEval,//availability_evalutation=device_availability_forEval
            'device_used_perClaim' =>  $request->device_used_perClaim,//device_use_perclaim=device_used_perClaim
            'device_origin_country' =>  $request->device_origin_country,//not_regulate_country=device_origin_country

            'event_date' =>  $request->event_date,
            'explant_or_implant_date' =>  $request->explant_or_implant_date,//explant_date=explant_or_implant_date
            'event_location' =>  $request->event_location,
            'device_operator' =>  $request->device_operator,

            'device_current_location' =>  $request->device_current_location,//device_current_location=device_current_location   //have to share api

            'device_use_after_incidence' =>  $request->device_use_after_incidence,//have share api
            'serious_death_date' =>  $request->serious_death_date,

            'other_device_name' =>  $request->xxxx,
            'event_details' =>  $request->xxxx,
            'adv_event_year' =>  $request->adv_event_year,//event_year=adv_event_year
            'adv_event_no' =>  $request->adv_event_no,//similar_event_no=adv_event_no

            'patient_hospital_id' =>  $request->patient_hospital_id,
            'patient_initial' =>  $request->patient_initial,
            'patient_age' =>  $request->patient_age,
            'patient_gender' =>  $request->patient_gender,
            'patient_weight' =>  $request->patient_weight,
            'other_relvent_history' =>  $request->other_relvent_history,
            'patient_outcome_date' =>  $request->patient_outcome_date,
            'is_patient_recovered' =>  $request->is_patient_recovered,
            'patient_outcome_death_date' =>  $request->patient_outcome_death_date,
            'patient_outcome_other' =>  $request->patient_outcome_other,

            'facility_name' =>  $request->facility_name,
            'facility_address' =>  $request->facility_address,
            'facility_contact_person' =>  $request->facility_contact_person,
            'facility_tel_no' =>  $request->facility_tel_no,//facility_no=facility_tel_no
            'action_taken' =>  $request->action_taken,
            'root_cause' =>  $request->root_cause,
           
           
            'device_destroyed' =>  $request->device_destroyed,
            // 'device_current_location' =>  $request->xxxx,
            'other_device_current_location' =>  $request->other_device_current_location,
            'serious_event' =>  $request->serious_event,
            
            
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
                'report_date' =>  $request->report_date,
                'report_type' =>  $request->report_type,
                'refrence_report' =>  $request->refrence_report,

                'rp_type' =>  $request->rp_type,//rp=reporter
                'rp_name' =>  $request->rp_name,
                'rp_number' =>  $request->rp_number,
                'rp_gender' =>  $request->rp_gender,
                'rp_address' =>  $request->rp_address,
                'rp_email' =>  $request->rp_email,
                'rp_type_other' =>  $request->rp_type_other,
                'rp_informed_incident' =>  $request->rp_informed_incident,
                'rp_submit_report' =>  $request->rp_submit_report,

                
                

                'medical_device' =>  $request->medical_device,//have to share api

                'vitro_diagnostic' =>  $request->vitro_diagnostic,//have to share api

                'medical_equipments' =>  $request->medical_equipments,//have to share api

                'device_name' =>  $request->device_name,
                'deviceDetails' =>  json_encode($request->deviceDetails),
                

                'manufacture_name' =>  $request->manufacture_name,
                'manufacture_address' =>  $request->manufacture_address,
                'importer_name' =>  $request->importer_name,

                'importer_address' =>  $request->importer_address,
                'distributor_name' =>  $request->distributor_name,
                'distributor_address' =>  $request->distributor_address,

                
                'device_notifiedOrRegulated' =>  $request->device_notifiedOrRegulated,//device_regulated_india=device_notifiedOrRegulated
                'device_risk_class' =>  $request->device_risk_class,//device_risk_mdr=device_risk_class
                'license_no' =>  $request->license_no,
                // 'catalogue_name' =>  $request->catalogue_name,
                'catalogue_no' =>  $request->catalogue_no,

                'model_no' =>  $request->model_no,
                'lot_no' =>  $request->lot_no,
                'serial_number' =>  $request->serial_number,
                'software_version' =>  $request->software_version,

                'associated_device' =>  $request->associated_device,
                'nomenclature_code' =>  $request->nomenclature_code,
                'udi_no' =>  $request->udi_no,
                'installation_date' =>  $request->installation_date,

                'expire_date' =>  $request->expire_date,
                'last_maintenance_date' =>  $request->last_maintenance_date,
                'last_cailbration_date' =>  $request->last_cailbration_date,
                'manufacturing_year' =>  $request->manufacturing_year,

                'machine_use_duration' =>  $request->machine_use_duration,//long_machine_use=machine_use_duration
                'device_availability_forEval' =>  $request->device_availability_forEval,//availability_evalutation=device_availability_forEval
                'device_used_perClaim' =>  $request->device_used_perClaim,//device_use_perclaim=device_used_perClaim
                'device_origin_country' =>  $request->device_origin_country,//not_regulate_country=device_origin_country

                'event_date' =>  $request->event_date,
                'explant_or_implant_date' =>  $request->explant_or_implant_date,//explant_date=explant_or_implant_date
                'event_location' =>  $request->event_location,
                'event_location_other' =>  $request->event_location_other,
                'device_operator' =>  $request->device_operator,

                'device_current_location' =>  $request->device_current_location,//device_current_location=device_current_location   //have to share api

                'device_use_after_incidence' =>  $request->device_use_after_incidence,//have share api
                'serious_death_date' =>  $request->serious_death_date,

                'other_device_name' =>  $request->xxxx,
                'event_details' =>  $request->xxxx,
                'adv_event_year' =>  $request->adv_event_year,//event_year=adv_event_year
                'adv_event_no' =>  $request->adv_event_no,//similar_event_no=adv_event_no

                'patient_hospital_id' =>  $request->patient_hospital_id,
                'patient_initial' =>  $request->patient_initial,
                'patient_age' =>  $request->patient_age,
                //
                'patient_name' =>  $request->patient_name,
                 //
                'patient_gender' =>  $request->patient_gender,
                'patient_weight' =>  $request->patient_weight,
                'other_relvent_history' =>  $request->other_relvent_history,
                'patient_outcome_date' =>  $request->patient_outcome_date,
                'is_patient_recovered' =>  $request->is_patient_recovered,
                'patient_outcome_death_date' =>  $request->patient_outcome_death_date,
                'patient_outcome_other' =>  $request->patient_outcome_other,

                'facility_name' =>  $request->facility_name,
                'facility_address' =>  $request->facility_address,
                'facility_contact_person' =>  $request->facility_contact_person,
                'facility_tel_no' =>  $request->facility_tel_no,//facility_no=facility_tel_no
                'action_taken' =>  $request->action_taken,
                'root_cause' =>  $request->root_cause,
               
               
                'device_destroyed' =>  $request->device_destroyed,
                // 'device_current_location' =>  $request->xxxx,
                'other_device_current_location' =>  $request->other_device_current_location,
                'serious_event' =>  $request->serious_event,
                'created_by'=>Auth::guard('api')->id(),
                
            ];  

            $status=DB::table('voluntryMedicalDeviceForm')->insert($data);
  
            if($status){

                return response()->json(["status"=>true,"message"=>"Consumer Medical Device Form Saved Successfully.",],201);
            }

            
            return response()->json([
                "status"=>false,
                 "message"=>"Consumer Medical Device Form not Saved Successfully. Please try again.",
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

    public function getMedicalDevice(){
        // $data=\DB::table('m_medical_device')->get();
    }


}