<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Appointment;
use Validator;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{

    public function index()
    {
        return AppointmentResource::collection(Appointment::all());
    }

    public function userAppoimtments($id){

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prescription' => 'required',     
            'date' => 'required',      
            'doctor_id' => 'required',
            'user_id' => 'required',
            'medicalplaces_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $appointment = new Appointment();
        $appointment->prescription = $request->prescription;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->user_id = $request->user_id;
        $appointment->date = $request->date;
        $appointment->medicalplaces_id = $request->medicalplaces_id;
        $appointment->save();   
        return response()->json(["success"=>"Recorded Successfully!"],201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'prescription' => 'required',          
            'doctor_id' => 'required',
            'user_id' => 'required',
            'medicalplaces_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $appointment = Appointment::find($id);
        $appointment->prescription = $request->prescription;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->user_id = $request->user_id;
        $appointment->medicalplaces_id = $request->medicalplaces_id;
        $appointment->update();
        return response()->json([$appointment], 200);
    }
    

    public function destroy($id)
    {
        $appointment= Appointment::find($id);
        if(is_null($appointment))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $appointment->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}