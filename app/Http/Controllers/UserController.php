<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    public function index()
    {
        return EmployeeResource::collection(User::all());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'job' => 'required',
            'birthdate' => 'required',
            'cutoflegs' => 'required',
            'cutofarms' => 'required',
            'chronicdisease' => 'required',
            'monthlyincome' => 'required',
            'mobilefees' => 'required',
            'noofcars' => 'required',
            'carmodel' => 'required',
            'bloodtype' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'insurance' => 'required',
            'password' => 'required|confirmed|min:6',  
            'accepted' => 'required',          
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->job = $request->job;
        $user->birthdate = $request->birthdate;
        $user->cutoflegs = $request->cutoflegs;
        $user->cutofarms = $request->cutofarms;
        $user->chronicdisease = $request->chronicdisease;
        $user->monthlyincome = $request->monthlyincome;
        $user->mobilefees = $request->mobilefees;
        $user->noofcars = $request->noofcars;
        $user->carmodel = $request->carmodel;
        $user->bloodtype = $request->bloodtype;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->insurance = $request->insurance;
        $user->accepted = $request->accepted;
        $user->save();
        $token = $user->createToken('User')->accessToken;    
        return response()->json([$user,['user-token' => $token]], 200);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (request()->password && request('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $user->password = bcrypt($request->password);
        }

        if (request()->email && request('username') != '' && request('username') != $user->email){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:admins',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $user->username = $request->username;
        }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->job = $request->job;
        $user->birthdate = $request->birthdate;
        $user->cutoflegs = $request->cutoflegs;
        $user->cutofarms = $request->cutofarms;
        $user->chronicdisease = $request->chronicdisease;
        $user->monthlyincome = $request->monthlyincome;
        $user->mobilefees = $request->mobilefees;
        $user->noofcars = $request->noofcars;
        $user->carmodel = $request->carmodel;
        $user->bloodtype = $request->bloodtype;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->insurance = $request->insurance;
        $user->accepted = $request->accepted;
        $user->update();
        return response()->json([$user], 200);
    }
    
    // user Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $token = Auth::guard('user')->user()->createToken('User')->accessToken;
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
        $user= User::find($id);
        if(is_null($user))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $user->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}