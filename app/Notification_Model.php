<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Notification_Model extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'type_of_notification', 'title_html', 'body_html', 'is_read'];
  
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}