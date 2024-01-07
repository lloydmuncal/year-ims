<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Storage;
use App;

class UploadController extends Controller
{
    private function base64Decode($file){
        $data = $file;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        return base64_decode($data);
    }
    public function filesSystem(){
        if(App::environment('development')){
            return 'fs_local';
        }else{
            return 'public';
        }
    }


    public function uploadBackGround(Request $request){
        $fileDetailsArray = json_decode($request->data);
        foreach ($fileDetailsArray as $fileDetails) {
            $path = 'Background\\' . $fileDetails->filename;
            Storage::disk($this->filesSystem())->put($path, $this->base64Decode($fileDetails->data));
            $fileDetails->path= $path;
        }
        return  $fileDetailsArray;
    }
    public function uploadCover(Request $request){
        $fileDetailsArray = json_decode($request->data);
        foreach ($fileDetailsArray as $fileDetails) {
            $path = 'Cover\\' . $fileDetails->filename;
            Storage::disk($this->filesSystem())->put($path, $this->base64Decode($fileDetails->data));
            $fileDetails->path= $path;
        }
        return  $fileDetailsArray;
    }
    public function uploadAvatar(Request $request){
        $file_details = json_decode($request->data[0]);
        $path = 'Avatar\\'.$file_details->filename;
        Storage::disk($this->filesSystem())->put($path , $this->base64Decode($file_details->data));
        return 'Image uploaded successfully';
    }
    public function uploadImage2(Request $request){
        $file_details = json_decode($request->data[0]);
        $path = 'student_pic\\'.$file_details->filename;
        Storage::disk($this->filesSystem())->put($path , $this->base64Decode($file_details->data));
        return 'Image uploaded successfully';
    }
    public function uploadImage(Request $request) {
        $fileDetailsArray = json_decode($request->data);
        foreach ($fileDetailsArray as $fileDetails) {
            $path = 'student_pic\\' . $fileDetails->filename;
            Storage::disk($this->filesSystem())->put($path, $this->base64Decode($fileDetails->data));
        }
        return 'Image uploaded successfully';
    }







    public function get_img($file_name){
        // return 'wow';
        try{
            $viewable = [
                'jpg',
                'png'
            ];
            $path = 'student_pic\\'.$file_name;
            // $path = 'student_pic\\'.$file_name;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $inline = in_array(strtolower($extension), $viewable) ? 'inline' : 'attachment';
            $temp_filepath = tempnam(sys_get_temp_dir(), '');
            $file_data = Storage::disk($this->filesSystem())->get($path);
            return $file_data;
            file_put_contents($temp_filepath, $file_data);

            return response()
                ->download($temp_filepath, $file_name, ['filename' => $file_name], $inline)
                ->deleteFileAfterSend();
        }  catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }

    }
    public function get_bg($file_name){
        try{
            $viewable = [
                'jpg',
                'png'
            ];
            $path = 'Background\\'.$file_name;
            // $path = 'student_pic\\'.$file_name;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $inline = in_array(strtolower($extension), $viewable) ? 'inline' : 'attachment';
            $temp_filepath = tempnam(sys_get_temp_dir(), '');
            $file_data = Storage::disk($this->filesSystem())->get($path);
            return $file_data;
            file_put_contents($temp_filepath, $file_data);

            return response()
                ->download($temp_filepath, $file_name, ['filename' => $file_name], $inline)
                ->deleteFileAfterSend();
        }  catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }

    }
    public function get_cover($file_name){
        try{
            $viewable = [
                'jpg',
                'png'
            ];
            $path = 'Cover\\'.$file_name;
            // $path = 'student_pic\\'.$file_name;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $inline = in_array(strtolower($extension), $viewable) ? 'inline' : 'attachment';
            $temp_filepath = tempnam(sys_get_temp_dir(), '');
            $file_data = Storage::disk($this->filesSystem())->get($path);
            return $file_data;
            file_put_contents($temp_filepath, $file_data);

            return response()
                ->download($temp_filepath, $file_name, ['filename' => $file_name], $inline)
                ->deleteFileAfterSend();
        }  catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }

    }
    public function get_avatar($file_name){
        try{
            $viewable = [
                'jpg',
                'png'
            ];
            $path = 'Avatar\\'.$file_name;
            // $path = 'student_pic\\'.$file_name;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $inline = in_array(strtolower($extension), $viewable) ? 'inline' : 'attachment';
            $temp_filepath = tempnam(sys_get_temp_dir(), '');
            $file_data = Storage::disk($this->filesSystem())->get($path);
            return $file_data;
            file_put_contents($temp_filepath, $file_data);
            return response()
                ->download($temp_filepath, $file_name, ['filename' => $file_name], $inline)
                ->deleteFileAfterSend();
        }  catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }
}
