<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest_Areas extends Model
{
    protected $table = 'interest_areas';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'category_id'];
    public $timestamps = false;
    
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}