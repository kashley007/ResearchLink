<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'academic_subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'department_id'];
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
