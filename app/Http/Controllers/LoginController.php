<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getUser(){
       $user = Login::all();
       return $user;
    }
    public function loginUser(Request $request){
        $user = Login::select('*')
        ->where('LRN_No',$request->Lrn_No)
        ->first();
        if ($user) {
            if (Hash::check($request->Password, $user->Password)) {
                if ($user->Status == 1) {
                    return $user;
                } else {
                    return 'User is inactive';
                }

            } else {
                return 'Password does not match';
            }
        }else{
            return 'LRN_No Not Exist';
        }
    }


    public function insertUser(Request $request){
        try {

            $existingUser = Login::where('LRN_No', $request->LRN_no)
            ->orWhere('Email', $request->Email)
            ->first();

            if ($existingUser) {
                // User already exists
                return response()->json(['message' => 'User with LRN_No or Email already exists.'], 400);
            }

            $user = new Login;
            $user->LRN_No= $request->LRN_no;
            $user->SurName= $request->SurName;
            $user->Mi= $request->Mi;
            $user->FirstName= $request->FirstName;
            $user->Suffix= $request->Suffix;
            $user->Email =$request->Email;
            $user->Password = Hash::make($request->Password);
            $user->PinCode= $request->PinCode;
            $user->Path= $request->Path;
            $user->Phone_No= $request->Phone_No;
            $user->Gender= $request->Gender;
            $user->Track=$request->Track;
            $user->Section= $request->Section;
            $user->Year= $request->Year;
            $user->UserType= $request->UserType;
            $user->Status= $request->Status;
            $user->save ();
            return "Data inserted successfully.";
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }



    public function VerifyLrn(Request $request){
        try {
            $user = Login::select('*')
            ->where('LRN_No',$request->Lrn_No)
            ->first();
            if ($user) {
                return $user;
            }
            else{
                return 'LRN_No Not Exist';
            }
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function GeneratePinCode(Request $request){
        try {
            $min = 100000;
            $max = 999999;
            $randomNumber = mt_rand($min, $max);
            $pin_number = strval($randomNumber);
            $user = Login::find($request->id);
            $user->PinCode = $pin_number;
            $user->save();
            return $pin_number;
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }

    public function VerifyPinCode(Request $request){
        try {
            $user = Login::select('*')
            ->where('LRN_No',$request->Lrn_No)
            ->where('PinCode',$request->PinCode)
            ->first();
            if ($user) {
                return $user;
            }
            else{
                return `Pin Code not match for this User:`;
            }
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function ChangePassword(Request $request){
        try {
            $user = Login::find($request->id);
            $user->Password =Hash::make($request->Password);;
            $user->save();
            return 'Password Has been Changed.';

        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function addAvatar(Request $request){
        try {
            $user = Login::find($request->id);
            $user->Path =$request->filename;
            $user->save();
            return 'Avatar has been Change.';
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
}
