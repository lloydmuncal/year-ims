<?php

namespace App\Http\Controllers;
use App\Models\YearBook;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class YearbookController extends Controller
{

    public function generateID(){
        $uuid = Str::uuid()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $currentDate = Carbon::today();
        $Year = $currentDate->format('Y');
        $Month=  $currentDate->format('m');
        $Day=  $currentDate->format('d');
        return 'YB'.$Year.$Month.$Day.substr($uuidWithoutHyphens, 0, 3);
    }


    // public function insertYearBook(Request $request){
    //     try {
    //         $requestData = $request->input('data');
    //         $yearbookId = $this->generateID();
    //         $bgData = [];
    //         foreach ($requestData as $req) {
    //             $bgData = [
    //                 'Yearbook_id' => $yearbookId,
    //                 'Title' => $req['Title'],
    //                 'Batch' => $req['Batch'],
    //                 'FileName' => $req['FileName'],
    //                 'EXT' => $req['EXT']  ?? null,
    //                 'Overide' => $req['Overide'] ?? null,
    //                 'SelectedCover' => $req['SelectedCover'],
    //                 'SelectedBackground' => $req['SelectedBackground'],
    //                 'Section' => $req['Section'],
    //                 'Page' => $req['Page'],
    //                 'Gallery' => $req['Gallery'],
    //                 'pic' => $req['pic'],
    //             ];
    //             YearBook::insert($bgData);
    //         }
    //         return "Data inserted successfully.";
    //     } catch (\Throwable $th) {
    //         return response()->json(["message"->$th],500);
    //     }
    // }


    public function insertYearBook(Request $request){
    try {
        $requestData = $request->input('data');
        $yearbookId = $this->generateID();
        foreach ($requestData as $req) {
            // $existingRecord = YearBook::where('id', $req['id'])->first();
            $existingRecord = isset($req['id']) ? YearBook::find($req['id']) : null;
            if ($existingRecord) {
                // If the record exists, update it
                $existingRecord->update([
                    'Title' => $req['Title'],
                    'Batch' => $req['Batch'],
                    'FileName' => $req['FileName'],
                    'Name'=>$req['Name'],
                    'EXT' => $req['EXT'] ?? null,
                    'Overide' => $req['Overide'] ?? null,
                    'SelectedCover' => $req['SelectedCover'],
                    'SelectedBackground' => $req['SelectedBackground'],
                    'Section' => $req['Section'],
                    'Page' => $req['Page'],
                    'Gallery' => $req['Gallery'],
                    'pic' => $req['pic'],
                ]);

            } else {
                // If the record doesn't exist, insert a new one

                $bgData = [
                    'Yearbook_id' => $yearbookId,
                    'Title' => $req['Title'],
                    'Batch' => $req['Batch'],
                    'FileName' => $req['FileName'],
                    'Name'=>$req['Name'],
                    'EXT' => $req['EXT']  ?? null,
                    'Overide' => $req['Overide'] ?? null,
                    'SelectedCover' => $req['SelectedCover'],
                    'SelectedBackground' => $req['SelectedBackground'],
                    'Section' => $req['Section'],
                    'Page' => $req['Page'],
                    'Gallery' => $req['Gallery'],
                    'pic' => $req['pic'],
                ];
                YearBook::insert($bgData);
            }
        }

        return "Data inserted/updated successfully.";
    } catch (\Throwable $th) {
        return response()->json(["message" => $th->getMessage()], 500);
    }
}



        public function deleteYearbook(Request $request){
            try {
                $Yearbook_id = $request->input('Yearbook_id');
                $del = YearBook::where('Yearbook_id', $Yearbook_id);
                if ($del) {
                    $del->delete();
                    return response()->json(['message' => 'Section soft deleted successfully'], 200);
                } else {
                    return response()->json(['message' => 'Section not found'], 404);
                }
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
        }

        public function getArchiveYearbook()
        {
            try {
                $archiveYearbooks = YearBook::select('Yearbook_id', 'Title', 'Batch', 'deleted_at')
                    ->whereNotNull('deleted_at')
                    ->distinct()
                    ->withTrashed() // Include soft-deleted records
                    ->get();

                return response()->json($archiveYearbooks);
            } catch (\Throwable $th) {
                return response()->json(["message" => $th->getMessage()], 500);
            }
        }

        public function RestoreYearbook(Request $request)
        {
            try {
                $Yearbook_id = $request->input('Yearbook_id');
                $yearbook = YearBook::where('Yearbook_id', $Yearbook_id)->withTrashed();;
                if (!$yearbook) {
                    return response()->json(['message' => 'Data not found for the specified Yearbook_id.'], 404);
                }
                $yearbook->update(['deleted_at' => null]);
                return response()->json($yearbook);
            } catch (\Throwable $th) {
                return response()->json(["message" => $th->getMessage()], 500);
            }
        }

        public function getYearbookCover()
        {
            try {
                $distinctData = YearBook::select('Yearbook_id', 'Title', 'Batch','SelectedCover')
                    ->distinct()
                    ->get();
                return response()->json($distinctData);
            } catch (\Throwable $th) {
                return response()->json(["message" => $th->getMessage()], 500);
            }
        }

    public function specificYearBook(Request $request)
    {
        try {
            $yearbook = YearBook::select('*')
            ->where('Yearbook_id',$request->Yearbook_id)
            ->get();
            return response()->json($yearbook);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
