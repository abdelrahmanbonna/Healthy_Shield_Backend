<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TblContactUs;
use Validator;

class TblContactUsController extends Controller
{

    public function index()
    {
        $tblcontactUs = TblContactUs::all();
        return response()->json($tblcontactUs,201);
    }

    public function store(Request $request)
    {
  
        $tblcontactUs = new TblContactUs();
        $user_email = User::find(auth()->id())->email;
        $tblcontactUs->name = $request->name;
        $tblcontactUs->email = $user_email;
        $tblcontactUs->message = $request->message;
        $tblcontactUs->phone = $request->phone;
        $tblcontactUs->accounttype = $request->accounttype;
        $tblcontactUs->save();
        return response()->json(["success"=>"Recorded Successfully!"],201);
    }
    

    public function destroy($id)
    {
        $tblcontactUs= TblContactUs::find($id);
        if(is_null($tblcontactUs))
        {
            return response()->json(["error"=>"Record Not Found!"],404);
        }
        $tblcontactUs->delete();
        return response()->json(["success"=>"Record Deleted Successfully!"],201);
    }
}