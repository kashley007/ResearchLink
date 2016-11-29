<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = false;
    
    public function opportunities()
    {
        return $this->hasMany('App\Research_Opportunities');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
}