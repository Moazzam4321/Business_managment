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
   
    public static function create_user($first_name,$last_name,$user_email,$dob,$user_image=null,$role = 'is_user')
    {
      return  User::create([
            'first_name'  => $first_name,
            'last_name'   => $last_name,
            'email'       => $user_email,
            'dob'         => $dob,
            'profile_picture' => $user_image,
            'password'    => '',
            'email_verified_at' => false,
            'role' => $role
        ]);
    }

    public static function update_user_data($user_id,$updated_data)
    {
        return User::where('id',$user_id)->update($updated_data);
    }   

    public static function get_user_data_by_email($user_email)
    {
        return User::where('email',$user_email)->first();
    } 
    
    public static function get_user_data_by_id($user_id)
    {
        return User::where('id',$user_id)->first();
    }
}
