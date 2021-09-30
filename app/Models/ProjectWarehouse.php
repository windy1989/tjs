<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectWarehouse extends Model {

    use HasFactory;

    protected $table      = 'project_warehouses';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'image',
        'date_receive',
        'warehouse_id',
        'person'
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
	
	public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }
}
