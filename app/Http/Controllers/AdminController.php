<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Admin;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function index()
    {
        return EmployeeResource::collection(Admin::all());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admins',
            'password' => 'required|confirmed|min:6',            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $admin = new Admin();
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $token = $admin->createToken('Admin')->accessToken;    
        return response()->json([$admin,['admin-token' => $token]], 200);
    }


    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (request()->password && request('password') != ''){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $admin->password = bcrypt($request->password);
        }

        if (request()->username && request('username') != '' && request('username') != $admin->username){
            $validator = Validator::make($request->all(), [
                'username' => 'required|username|unique:admins',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 401);
            }            
            $admin->username = $request->username;
        }
        
        $admin->update();
        return response()->json([$admin], 200);
    }
    
    // admin Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            $token = Auth::guard('admin')->user()->createToken('Admin')->accessToken;
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
        $admin= Admin::find($id);
        if(is_null($admin))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $admin->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}