<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64FileWithExtension implements Rule
{
    protected $allowed_extensions;
    protected $max_size;
    protected $message;

    public function __construct($max_size)
    {
       // $this->allowedExtensions = $allowedExtensions;
        $this->max_size = $max_size;
    }

    public function passes($attribute, $value)
    {
       $this->allowed_extensions = ['data:/png','data:/jpg','data:/jpeg','data:@file/jpeg','data:image/jpeg'];
       $file_data = explode(";",$value);
       $extension = $file_data[0];
       $file_content = base64_decode($value);

        // Get the file size
        $file_size = strlen($file_content);

       if(!(in_array($extension, $this->allowed_extensions))){
        $this->message = "The :attribute must be a base64 encoded file with the following extensions: " . implode(', ', $this->allowed_extensions);
        return false;
       }
        // Check if the file size is within the allowed limit
        if ($file_size > $this->max_size) {
            $this->message = "The :attribute must be less than " . $this->max_size . " bytes.";
            return false;
        }
        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
