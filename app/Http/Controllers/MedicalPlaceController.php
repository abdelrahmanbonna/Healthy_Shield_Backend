<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\MedicalPlace;
use Validator;
use App\Http\Resources\EmployeeResource;

class MedicalPlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:medicalplace');
    }

    public function index()
    {
        return EmployeeResource::collection(MedicalPlace::all());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',            
            'address' => 'required',
            'phone' => 'required',
            'fees' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $medicalplace = new MedicalPlace();
        $medicalplace->name = $request->name;
        $medicalplace->email = $request->email;
        $medicalplace->password = bcrypt($request->password);
        $medicalplace->address = $request->address;
        $medicalplace->phone = $request->phone;
        $medicalplace->fees = $request->fees;
        $medicalplace->save();
        $token = $medicalplace->createToken('MedicalPlace')->accessToken;    
        return response()->json([$medicalplace,['MedicalPlace-token' => $token]], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',            
            'address' => 'required',
            'phone' => 'required',
            'fees' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $medicalplace = MedicalPlace::find($id);
        if (request()->password && request('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $medicalplace->password = bcrypt($request->password);
        }

        if (request()->email && request('email') != '' && request('email') != $medicalplace->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $medicalplace->email = $request->email;
        }

        $medicalplace->name = $request->name;
        $medicalplace->password = bcrypt($request->password);
        $medicalplace->address = $request->address;
        $medicalplace->phone = $request->phone;
        $medicalplace->fees = $request->fees;
        $medicalplace->update();
        return response()->json([$medicalplace], 200);
    }
    
    // medicalplace Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (Auth::guard('medicalplace')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $token = Auth::guard('medicalplace')->user()->createToken('MedicalPlace')->accessToken;
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
        $medicalplace= MedicalPlace::find($id);
        if(is_null($medicalplace))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $medicalplace->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}