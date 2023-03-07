<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function tokens()
    {
        return $this->hasMany(User::class);
    }  
   
    public static function create_user($request,$user_email,$user_image="",$role = 'is_user')
    {
      return  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $user_email,
            'dob' => $request->dob,
            'profile_picture' => $user_image,
            'password' => '',
            'email_verified_at' => false,
            'role' => $role
        ]);
    }

    public static function update_user($user_id,$password)
    {
        return User::where('id',$user_id)->update(['password'=>Hash::make($password),
                                                    'email_verified_at'=> true ]);
    }   

    public static function find_user_by_email($user_email)
    {
        return User::where('email',$user_email)->first();
    }  
}
