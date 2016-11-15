<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function opportunities()
    {
        return $this->hasMany('App\Research_Opportunities');
    }
}