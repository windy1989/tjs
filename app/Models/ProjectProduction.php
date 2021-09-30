<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectProduction extends Model {

    use HasFactory;

    protected $table      = 'project_productions';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'image',
        'start_date',
        'finish_date',
        'note',
		'progress'
    ];
	
	public function image() 
    {
        if(Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return $image;
    }

}
