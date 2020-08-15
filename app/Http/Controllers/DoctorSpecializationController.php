<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\DoctorSpecialization;
use Validator;
use App\Http\Resources\EmployeeResource;

class DoctorSpecializationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctorspecialization');
    }

    public function index()
    {
        return EmployeeResource::collection(DoctorSpecialization::all());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'specialization' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $doctorspecialization = new DoctorSpecialization(); 
        $doctorspecialization->specialization = $request->specialization;
        $doctorspecialization->save(); 
        return response()->json(["success"=>"Recorded Successfully!"],201);
    }

    public function details()
    { 
        return response()->json([auth()->user()], 200);
    }

    public function destroy($id)
    {
        $doctorspecialization= DoctorSpecialization::find($id);
        if(is_null($doctorspecialization))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $doctorspecialization->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}