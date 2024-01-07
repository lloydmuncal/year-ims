<?php

namespace App\Http\Controllers;
use App\Models\UserMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserMaintenanceController extends Controller
{
    public function getUsers(){
        $user = UserMaintenance::get();
        return $user;
    }

    public function updateStatus(Request $request){
        {
            try {
                $request->validate([
                    'id' => 'required|exists:logins,id',
                    'Status' => 'required|boolean',
                ]);
                $user = UserMaintenance::findOrFail($request->id);
                $user->update(['Status' => $request->Status]);
                return response()->json(['message' => 'Status updated successfully']);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }

    public function deleteUser(Request $request){
        {
            try {
                // Find the user by ID
                $user = UserMaintenance::findOrFail($request->id);
                // Soft delete the user
                $user->delete();
                return response()->json(['message' => 'User soft deleted successfully.'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }
    public function updateUserInfo(Request $request){
        {
            try {
                $user = UserMaintenance::find($request->id);
                if($user){
                    // $user->update([
                    //     'LRN_No '=> $request->input('LRN_No '),
                    //     'FirstName' => $request->input('FirstName'),
                    //     'SurName' => $request->input('SurName'),
                    //     'Mi' => $request->input('MI'),
                    //     'Suffix' => $request->input('Suffix'),
                    // ]);
                        $user->LRN_No=$request->LRN_No;
                        $user->FirstName=$request->FirstName;
                        $user->SurName=$request->SurName;
                        $user->Mi=$request->Mi;
                        $user->Suffix=$request->Suffix;
                        $user->save();
                    return response()->json(['message' => 'User information updated successfully','data'=>$user], 200);
                }else{
                    return response()->json(['message' => 'Bad Request'], 400);
                }

            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }

    public function updateSecurityInfo(Request $request){
        {
            try {
                $user = UserMaintenance::find($request->id);
                if (!Hash::check($request->CurrentPassword, $user->Password)) {
                    return response()->json(['message' => 'Incorrect current password'], 200);
                }
                // $user->update([
                //     'Password' => Hash::make($request->NewPassword),
                // ]);
                $user->Password=Hash::make($request->NewPassword);
                $user->save();
                return response()->json(['message' => 'Password updated successfully'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }

    public function updateContactInfo(Request $request){
        {
            try {
                $user = UserMaintenance::find($request->id);
                    // $user->update([
                    //     'Email '=> $request->input('Email '),
                    //     'Phone_No '=> $request->input('Mobile'),
                    // ]);
                    $user->Email=$request->Email;
                    $user->Phone_No=$request->Mobile;
                    $user->save();
                return response()->json(['message' => 'Contact information updated successfully','data'=>$user], 200);


            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }

    public function updateOrInsert(Request $request)
    {

            try {
                $id = $request->input('id');
                if ($id) {
                    $user =UserMaintenance::find($request->id);
                    if($user){
                        // $user->update([
                        //     'LRN_No'=> $request->input('LRN_No'),
                        //     'SurName'=> $request->input('SurName'),
                        //     'Mi'=> $request->input('Mi'),
                        //     'FirstName'=> $request->input('FirstName'),
                        //     'Suffix'=> $request->input('Suffix'),
                        //     'Phone_No'=> $request->input('Mobile'),
                        //     'Email'=> $request->input('Email'),
                        //     'Gender'=> $request->input('Gender'),
                        //     'Track'=> $request->input('Track'),
                        //     'Section'=> $request->input('Section'),
                        //     'Year'=> $request->input('Year'),
                        //     'Status'=> $request->input('Status'),
                        // ]);
                        $user->LRN_No =$request->LRN_No;
                        $user->SurName =$request->SurName;
                        $user->Mi =$request->Mi;
                        $user->FirstName =$request->FirstName;
                        $user->Phone_No =$request->Phone_No;
                        $user->Email =$request->Email;
                        $user->Gender =$request->Gender;
                        $user->Track =$request->Track;
                        $user->Section =$request->Section;
                        $user->Year =$request->Year;
                        $user->Status =$request->Status;
                        $user->save();
                        return "Data Updated successfully.";
                    }
                    else {
                        return response()->json(['message' => 'Record not found'], 404);
                    }
                } else {
                    $existingUser = UserMaintenance::where('LRN_No', $request->LRN_No)
                    ->orWhere('Email', $request->Email)
                    ->first();
                    if ($existingUser) {
                        return response()->json(['message' => 'User with LRN_No or Email already exists.'], 400);
                    }
                    $user = new UserMaintenance;
                    $user->LRN_No= $request->LRN_No;
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
                }
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
    }
}
