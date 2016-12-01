<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notification_Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class NotificationController extends Controller
{
    public function delete($id) {
    	DB::table('notifications')->where('id', '=', $id)->delete();
    }
    public function markRead($id) {
    	$notification = Notification_Model::whereId($id)->first();
    	$notification->is_read = 1;
    	$notification->save();
    }
}