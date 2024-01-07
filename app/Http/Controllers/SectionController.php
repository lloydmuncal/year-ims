<?php

namespace App\Http\Controllers;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class SectionController extends Controller
{

    public function getAllSection(){
        $section = Section::get();
        return $section;
    }

    public function generateID(){
        $uuid = Str::uuid()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $currentDate = Carbon::today();
        $Year = $currentDate->format('Y');
        $Month=  $currentDate->format('m');
        $Day=  $currentDate->format('d');
        return 'SC'.substr($Year, 2, 2).$Month.$Day.substr($uuidWithoutHyphens, 0, 3);
    }

    public function insertSection(Request $request){
        try {
            $id = $request->input('id');
            if ($id) {
                $section =Section::find($request->id);
                if($section){
                    $section->Section_id =$request->Section_id;
                    $section->SectionName =$request->SectionName;
                    $section->save();
                    return "Data Updated successfully.";

                }else{
                    return response()->json(['message' => 'Record not found'], 404);
                }
            }
            else{
                $section = new Section;
                $section->Section_id= $this->generateID();
                $section->SectionName= $request->SectionName;
                $section->save();
                return response()->json(['message' => 'Section inserted successfully', 'section' => $section], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function deleteSection(Request $request){
        try {
            $id = $request->input('id');
            $section = Section::find($id);
            if ($section) {
                $section->delete();
                return response()->json(['message' => 'Section soft deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Section not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
