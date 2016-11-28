<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    
    public function opportunities()
    {
        return $this->hasMany('App\Research_Opportunities');
    }
}