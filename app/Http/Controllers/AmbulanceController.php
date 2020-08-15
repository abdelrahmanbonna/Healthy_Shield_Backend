<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Ambulance;
use Validator;
use App\Http\Resources\EmployeeResource;

class AmbulanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:ambulance');
    }

    public function index()
    {
        return EmployeeResource::collection(Ambulance::all());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|confirmed|min:6',
            'contactno' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $ambulance = new Ambulance();
        $ambulance->name = $request->name;
        $ambulance->email = $request->email;
        $ambulance->password = bcrypt($request->password);
        $ambulance->contactno = $request->contactno;
        $ambulance->address = $request->address;
        $ambulance->save();
        $token = $ambulance->createToken('Ambulance')->accessToken;    
        return response()->json([$ambulance,['ambulance-token' => $token]], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|confirmed|min:6',
            'contactno' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $ambulance = Ambulance::find($id);
        if (request()->password && request('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $ambulance->password = bcrypt($request->password);
        }

        if (request()->email && request('email') != '' && request('email') != $ambulance->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $ambulance->email = $request->email;
        }

        $ambulance->name = $request->name;
        $ambulance->email = $request->email;
        $ambulance->password = bcrypt($request->password);
        $ambulance->contactno = $request->contactno;
        $ambulance->address = $request->address;
        $ambulance->update();
        return response()->json([$ambulance], 200);
    }
    
    // ambulance Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (Auth::guard('ambulance')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $token = Auth::guard('ambulance')->user()->createToken('Ambulance')->accessToken;
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
        $ambulance= Ambulance::find($id);
        if(is_null($ambulance))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $ambulance->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}