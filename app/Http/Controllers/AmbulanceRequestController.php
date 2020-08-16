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
        $this->middleware('guest:request');
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
            'location_link' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $request = new Ambulance_Request();
        $request->user_id = $request->user_id;
        $request->date = $request->date;
        $request->location_link = $request->location_link;
        $request->save();  
        return response()->json(["success"=>"Recorded Successfully!"],200);
    }

    public function destroy($id)
    {
        $request= Ambulance_Request::find($id);
        if(is_null($request))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $request->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],200);
    }
}