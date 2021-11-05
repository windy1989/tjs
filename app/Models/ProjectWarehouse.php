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
		'user_id',
        'project_id',
		'project_purchase_id',
		'project_shipment_id',
		'code',
		'person',
        'image',
        'date_receive',
        'warehouse_id'
    ];
	
	public function attachment() 
    {
        if(Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return $image;
    }
	
	public static function generateCode()
    {
        $query = ProjectWarehouse::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'WR/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }
	
	public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse','warehouse_id','id');
    }
	
	public function projectWarehouseProduct()
    {
        return $this->hasMany('App\Models\ProjectWarehouseProduct');
    }
	
	public function projectPurchase()
    {
        return $this->belongsTo('App\Models\ProjectPurchase', 'project_purchase_id', 'id');
    }
	
	public function projectShipment()
    {
        return $this->belongsTo('App\Models\ProjectShipment', 'project_shipment_id', 'id');
    }
	
	public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
	
	public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
