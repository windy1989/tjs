<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDelivery extends Model {

    use HasFactory;

    protected $table      = 'project_deliveries';
    protected $primaryKey = 'id';
    protected $fillable   = [
		'user_id',
        'project_id',
		'project_sale_id',
		'code',
        'city_id',
        'receiver_name',
        'delivery_date',
        'email',
        'phone',
		'is_dropshipper',
		'dropshipper_id',
        'address',
		'warehouse_id',
		'vendor_id',
		'approved_by',
		'image'
    ];
	
	public function approve()
    {
        return $this->belongsTo('App\Models\User', 'approved_by', 'id');
    }

	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
	
	public function isDropshipper() 
    {
        switch($this->is_dropshipper) {
            case '2':
                $status = 'Yes';
                break;
            case '1':
                $status = 'No';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }
	
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }
	
	public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }
	
	public function dropshipper()
    {
        return $this->belongsTo('App\Models\Dropshipper','dropshipper_id','id');
    }
	
	public function projectSale()
    {
        return $this->belongsTo('App\Models\ProjectSale','project_sale_id','id');
    }
	
	public function project()
    {
        return $this->belongsTo('App\Models\Project','project_id','id');
    }
	
	public function projectDeliveryProduct()
    {
        return $this->hasMany('App\Models\ProjectDeliveryProduct');
    }
	
	public function projectDeliveryTrack()
    {
        return $this->hasMany('App\Models\ProjectDeliveryTrack');
    }
	
	public static function generateCode()
    {
        $query = ProjectDelivery::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'DO/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
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
