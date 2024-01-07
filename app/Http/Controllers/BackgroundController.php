<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Background;

class BackgroundController extends Controller
{
    public function getBackground(){
        $bg = Background::get();
        return $bg;
    }
    public function generateID(){
        $uuid = Str::uuid()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $currentDate = Carbon::today();
        $Year = $currentDate->format('Y');
        $Month=  $currentDate->format('m');
        $Day=  $currentDate->format('d');
        return 'BK'.$Year.$Month.$Day.substr($uuidWithoutHyphens, 0, 3);
    }
    public function insertBackground(Request $request){
        try {
            $requestData = $request->input('data');
            $bgData = [];
                    foreach ($requestData as $req) {
                $existingBackground = Background::where('FileName', $req['filename'])->first();
                    $bgData = [
                        'Background_id' => $this->generateID(),
                        'Name' => $req['name'],
                        'FileName' => $req['filename'],
                        'EXT' => $req['ext'],
                        'Path' => $req['path'],
                        'Overide' => $req['overide'],
                    ];
                    if ($existingBackground) {
                        Background::where('FileName', $req['filename'])->update($bgData);
                    } else {
                        Background::insert($bgData);
                    }
                }
                 return response()->json(["message" => "Backgrounds inserted or updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
    public function deleteBackground(Request $request){
        {
            try {
                // Find the user by ID
                $user = Background::findOrFail($request->id);
                // Soft delete the user
                $user->delete();
                return response()->json(['message' => 'Background deleted successfully.'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }
    }

    public function getBG(Request $request){
        $user = Background::select('*')
        ->where('Background_id ',$request->SelectedBackground)
        ->first();
        if ($user) {
            return $user;
        }else{
            return 'Background not exist';
        }
    }
}
