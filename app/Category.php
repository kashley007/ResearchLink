<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function opportunities()
    {
        return $this->hasMany('App\Research_Opportunities');
    }
}