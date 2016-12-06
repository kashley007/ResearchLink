<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research_Agency extends Model
{
    protected $table = 'research_agencies';
    protected $primaryKey = 'id';

    public function opportunities()
    {
        return $this->hasMany('App\Research_Opportunity');
    }
}
