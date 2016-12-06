<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research_Opportunity extends Model
{
    protected $table = 'research_opportunities';
    protected $primaryKey = 'id';

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function agency()
    {
    	return $this->belongsTo('App\Research_Agency');
    }

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
