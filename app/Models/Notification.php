<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    use HasFactory;

    protected $table      = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'seen',
        'title',
        'description',
        'link'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
	
	public static function sendNotif($role,$title,$description,$link)
    {
        $row = UserRole::whereIn('role',$role)->get();

		foreach($row as $r){
			Notification::create([
				'user_id' 		=> $r->user_id,
				'seen'			=> 1,
				'title'			=> $title,
				'description'	=> $description,
				'link'			=> $link
			]);
		}
    }
}
