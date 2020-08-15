<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Ambulance_Request;
use Validator;
use App\Http\Resources\EmployeeResource;

class AmbulanceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:employee');
    }

    public function index()
    {
        return EmployeeResource::collection(Ambulance_Request::all());
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $employee = new Ambulance_Request();
        $employee->user_id = $request->user_id;
        $employee->date = $request->date;
        $employee->save();  
        return response()->json(["success"=>"Recorded Successfully!"],201);
    }

    public function destroy($id)
    {
        $employee= Ambulance_Request::find($id);
        if(is_null($employee))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $employee->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}