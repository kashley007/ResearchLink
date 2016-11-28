<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses_Taken extends Model
{
    protected $table = 'courses_taken';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'course_id'];
    public $timestamps = false;
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}