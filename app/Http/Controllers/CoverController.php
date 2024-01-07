<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Cover;

class CoverController extends Controller
{

    public function getCoverPage(){
        $bg = Cover::get();
        return $bg;
    }
    public function generateID(){
        $uuid = Str::uuid()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $currentDate = Carbon::today();
        $Year = $currentDate->format('Y');
        $Month=  $currentDate->format('m');
        $Day=  $currentDate->format('d');
        return 'CV'.$Year.$Month.$Day.substr($uuidWithoutHyphens, 0, 3);
    }

    public function insertCover(Request $request){
        try {
            $requestData = $request->input('data');
            $CoverData = [];
            foreach ($requestData as $req) {
                $existingBackground = Cover::where('FileName', $req['filename'])->first();
                    $CoverData = [
                        'Cover_id' => $this->generateID(),
                        'Name' => $req['name'],
                        'FileName' => $req['filename'],
                        'EXT' => $req['ext'],
                        'Path' => $req['path'],
                        'Overide' => $req['overide'],
                    ];
                    if ($existingBackground) {
                        Cover::where('FileName', $req['filename'])->update($CoverData);
                    } else {
                        Cover::insert($CoverData);
                    }
                }
                 return response()->json(["message" => "Cover inserted or updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function deleteCover(Request $request){
        {
            try {
                // Find the user by ID
                $user = Cover::findOrFail($request->id);
                // Soft delete the user
                $user->delete();
                return response()->json(['message' => 'Cover deleted successfully.'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }


}

