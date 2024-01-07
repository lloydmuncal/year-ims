<?php

namespace App\Http\Controllers;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class TrackController extends Controller
{

    public function getAllTrack(){
        $user = Track::get();
        return $user;
    }

    public function generateID(){
        $uuid = Str::uuid()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $currentDate = Carbon::today();
        $Year = $currentDate->format('Y');
        $Month=  $currentDate->format('m');
        $Day=  $currentDate->format('d');
        return 'T0'.substr($Year, 2, 2).$Month.$Day.substr($uuidWithoutHyphens, 0, 3);
    }

    public function insertTrack(Request $request){
        try {
            $id = $request->input('id');
            if ($id) {
                $track =Track::find($request->id);
                if($track){
                    $track->Track_id =$request->Track_id;
                    $track->TrackName =$request->TrackName;
                    $track->save();
                    return "Data Updated successfully.";

                }else{
                    return response()->json(['message' => 'Record not found'], 404);
                }
            }
            else{
                $track = new Track;
                $track->Track_id= $this->generateID();
                $track->TrackName= $request->TrackName;
                $track->save();
                return response()->json(['message' => 'Track inserted successfully', 'track' => $track], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function deleteTrack(Request $request){
        try {
            $id = $request->input('id');
            $track = Track::find($id);
            if ($track) {
                $track->delete();
                return response()->json(['message' => 'Track soft deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Track not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
