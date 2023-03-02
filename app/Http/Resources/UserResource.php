<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> data_get($this,'id',''),
            'first_name'=> data_get($this,'first_name',''),
            'last_name'=> data_get($this,'last_name',''),
            'email'=> data_get($this,'email',''),
            'dob' => data_get($this,'dob',''),
            'profile_picture' => data_get($this,'profile_picture','')
        ];
    }
}
