<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Doctor;
use Validator;
use App\Http\Resources\EmployeeResource;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor');
    }

    public function index()
    {
        return EmployeeResource::collection(Doctor::all());
    }
 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|confirmed|min:6',            
            'address' => 'required',
            'phone' => 'required',
            'doctorspecialization_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->doctorspecialization_id = $request->doctorspecialization_id;
        $doctor->save();
        $token = $doctor->createToken('Doctor')->accessToken;    
        return response()->json([$doctor,['doctor-token' => $token]], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|confirmed|min:6',            
            'address' => 'required',
            'phone' => 'required',
            'doctorspecialization_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $doctor = Doctor::find($id);
        if (request()->password && request('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $doctor->password = bcrypt($request->password);
        }

        if (request()->email && request('email') != '' && request('email') != $doctor->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $doctor->email = $request->email;
        }

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->doctorspecialization_id = $request->doctorspecialization_id;
        $doctor->update();
        return response()->json([$doctor], 200);
    }
    
    // doctor Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $token = Auth::guard('doctor')->user()->createToken('Doctor')->accessToken;
            return response()->json(['access_token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function details()
    { 
        return response()->json([auth()->user()], 200);
    }

    public function destroy($id)
    {
        $doctor= Doctor::find($id);
        if(is_null($doctor))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $doctor->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}