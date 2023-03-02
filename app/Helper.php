<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function save_image_in_local_path($image)
    {
        $image_original_name= $image->getClientOriginalName();
        $image_name= time().'.'.$image_original_name;
        $file_path = str_replace('/', '\\', storage_path('app/public'));
        file_put_contents($file_path.'/'.$image_name, file_get_contents($image));
        return $image_name;
    }
}