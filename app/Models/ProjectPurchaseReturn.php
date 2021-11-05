<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProjectPurchaseReturn extends Model {

    use HasFactory;

    protected $table      = 'project_purchase_returns';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
		'project_id',
        'project_purchase_id',
        'code',
        'warehouse_id',
		'image',
		'note',
		'approved_by'
    ];
	
	public function approve()
    {
        return $this->belongsTo('App\Models\User', 'approved_by', 'id');
    }

	public static function generateCode()
    {
        $query = ProjectPurchaseReturn::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'PR/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }
	
	public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse','warehouse_id','id');
    }
	
	public function projectPurchase()
    {
        return $this->belongsTo('App\Models\ProjectPurchase','project_purchase_id','id');
    }
	
	public function projectPurchaseReturnProduct()
    {
        return $this->hasMany('App\Models\ProjectPurchaseReturnProduct');
    }
	
	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
	
	public function attachment() 
    {
        if(Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return $image;
    }
}
