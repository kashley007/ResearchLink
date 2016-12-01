<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

use View;

class User extends Authenticatable
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'confirmation_code', 'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
    
    public function coursesTaken()
    {
        return $this->hasMany('App\Courses_Taken');
    }
    
    public function coursesTaught()
    {
        return $this->hasMany('App\Courses_Taught');
    }
    
    public function interestAreas()
    {
        return $this->hasMany('App\Interest_Areas');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Notification_Model');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function($model)
        {
            $profile = new Profile;
            $profile->user_id = $model->id;
            $profile->save();
        });
    }
}
