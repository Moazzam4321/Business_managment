<?php

namespace App\Models\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Usertoken extends Model
{
    use HasFactory;
    protected $table= 'user_token';
    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public static function user_token($user_id,$token_type)
    { 
      $token = Str::random(20);
      return  Usertoken::create([
        'user_id' => $user_id,
        'token'  =>  $token,
        'token_type' => $token_type
      ]);
      
    }

    public static function is_token_exist($token)
    {
      //dd("ok");
     return @Usertoken::where('token', $token)
                      ->where('created_at','>=',Carbon::now()->subMinutes(18000))->first();
    }

    public static function delete_token($token_id)
    {
      Usertoken::where('id',$token_id)->delete();
    }
}
