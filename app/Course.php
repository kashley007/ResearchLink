<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'idcourses';
    protected $fillable = ['course_number', 'name', 'academic_subject'];
    public $timestamps = false;
    
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
