<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Usertoken extends Model
{
    use HasFactory;
    protected $table= 'user_tokens';
    protected $guarded = [];

    public static function user_token($user_id,$token_type)
    { 
      $token = Str::random(20);
      return  Usertoken::create([
        'user_id' => $user_id,
        'token'  =>  $token,
        'token_type' => $token_type
      ]);
      
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
