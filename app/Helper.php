<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if(!function_exists('get_file_extension')){
    function get_file_extension($file_content , $user_email = null)
    {
        try{
        @list($type, $file_data) = explode(";",$file_content);
        @list(, $type) = explode('/',$type);
        @list(, $file_data) = explode(',', $file_data); 
        $file_name = time().str::random(20).'.'.$type;
        $file_content = base64_decode($file_data);
        Storage::disk('local')->put($file_name, $file_content);
        $file_path = Storage::path($file_name);
        return $file_path;

        }catch(Exception $e){
            Log::warning('Unable to upload file',['user_email'=> $user_email]);
        }
    }
}