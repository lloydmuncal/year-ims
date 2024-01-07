<?php

namespace App\Http\Controllers;
use App\Models\records;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    public function getAllRecords(){
        $records = records::get();
        return $records;
    }

    public function getTotalCount()
    {
        $count = records::count();
        return $count;
    }

    public function getLrnRecord(Request $request){
        $lrn = $request->input('LRN_no');
        $records = records::where('LRN_No', $lrn)->get();
        if($records){
            return $records;
        }

    }

    public function getPerSectionRecords()
    {
        $records = records::select('Section')
        ->selectRaw('SUM(CASE WHEN Gender = "Male" THEN 1 ELSE 0 END) AS MALE')
        ->selectRaw('SUM(CASE WHEN Gender = "Female" THEN 1 ELSE 0 END) AS FEMALE')
        ->selectRaw('COUNT(*) AS Total')
        ->groupBy('Section')
        ->get();
            return $records;
    }

    public function getPerTrackYearRecords()
    {
        $records = records::select('Track', 'Year')
            ->selectRaw('COUNT(*) AS Total')
            ->groupBy('Track', 'Year')
            ->get();

        return $records;
    }

    public function insertRecords(Request $request){
        try {
            $id = $request->input('id');
            if ($id) {
                $records =records::find($request->id);
                if($records){
                    $records->LRN_No =$request->LRN_No;
                    $records->SurName =$request->SurName;
                    $records->Mi =$request->Mi;
                    $records->FirstName =$request->FirstName;
                    $records->Suffix =$request->Suffix;
                    $records->Gender =$request->Gender;
                    $records->Track =$request->Track;
                    $records->Section =$request->Section;
                    $records->Year =$request->Year;
                    $records->Adviser =$request->Adviser;
                    $records->save();
                    return "Data Updated successfully.";
                }else{
                    return response()->json(['message' => 'Record not found'], 404);
                }
            }
            else{
                $records = new records;
                $records->LRN_No =$request->LRN_No;
                $records->SurName =$request->SurName;
                $records->Mi =$request->Mi;
                $records->FirstName =$request->FirstName;
                $records->Suffix =$request->Suffix;
                $records->Gender =$request->Gender;
                $records->Track =$request->Track;
                $records->Section =$request->Section;
                $records->Year =$request->Year;
                $records->Adviser =$request->Adviser;
                $records->save();
                return response()->json(['message' => 'Record inserted successfully', 'Record' => $records], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function deleteRecord(Request $request){
        try {
            $id = $request->input('id');
            $record = records::find($id);
            if ($record) {
                $record->delete();
                return response()->json(['message' => 'Section soft deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Section not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

}
