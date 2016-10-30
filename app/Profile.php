<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{
    protected $table = 'profile';
    protected $primaryKey = 'user_id';
    protected $fillable = ['address', 'city', 'state', 'zipcode', 'phone', 'image_name', 'user_type'];
 
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}