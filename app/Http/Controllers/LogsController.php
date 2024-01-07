<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Logs;

class LogsController extends Controller
{

    public function getLogs(){
        $bg = Logs::get();
        return $bg;
    }
    public function LoginLogs(Request $request){
        try {
            $type= 'Login';
            $user = new Logs;
            $user->TypeofLogs=$type;
            $user->Date = Carbon::now();
            $user->FirstName= $request->FirstName;
            $user->LastName= $request->SurName;
            $user->LRN= $request->LRN_No;
            $user->Details =$request->Details;
            $user->save ();
            return "Data inserted successfully.";
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function DownloadLogs(Request $request){
        try {
            $type= 'Download';
            $user = new Logs;
            $user->TypeofLogs=$type;
            $user->Date = Carbon::now();
            $user->FirstName= $request->FirstName;
            $user->LastName= $request->SurName;
            $user->LRN= $request->LRN_No;
            $user->Details =$request->Details;
            $user->save ();
            return "Data inserted successfully.";
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function ArchiveLogs(Request $request){
        try {
            $type= 'Archive';
            $user = new Logs;
            $user->TypeofLogs=$type;
            $user->Date = Carbon::now();
            $user->FirstName= $request->FirstName;
            $user->LastName= $request->SurName;
            $user->LRN= $request->LRN_No;
            $user->Details =$request->Details;
            $user->save ();
            return "Data inserted successfully.";
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
}
