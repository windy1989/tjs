<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProjectPurchase extends Model {

    use HasFactory;

    protected $table      = 'project_purchases';
    protected $primaryKey = 'id';
    protected $fillable   = [
		'user_id',
		'project_id',
        'project_sale_id',
        'code',
		'note',
		'supplier_id',
		'production_lead_time',
		'estimated_delivery',
		'estimated_arrival',
		'factory_name',
		'customer_id',
		'sales_id',
		'on_behalf',
		'delivery_address',
		'country_id',
		'city_id',
		'courier_method',
		'pic',
		'pic_no',
		'payment_method',
		'price',
		'currency_id',
		'brand_on_box',
		'sni',
		'checked_by',
		'approved_by'
    ];

	public function price()
    {
        switch($this->price) {
            case '1':
                $price = 'FOB';
                break;
            case '2':
                $price = 'EXW';
                break;
            case '3':
                $price = 'Franco';
                break;
            case '4':
                $price = 'CIF';
                break;
			default:
                $price = 'Invalid';
                break;
        }

        return $price;
    }
	
	public function checked()
    {
        return $this->belongsTo('App\Models\User', 'checked_by', 'id');
    }
	
	public function approved()
    {
        return $this->belongsTo('App\Models\User', 'approved_by', 'id');
    }
	
	public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id', 'id');
    }
	
	public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }
	
	public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
	
	public function sales()
    {
        return $this->belongsTo('App\Models\User', 'sales_id', 'id');
    }
	
	public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
	
	public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
	
	public function projectSale()
    {
        return $this->belongsTo('App\Models\ProjectSale', 'project_sale_id', 'id');
    }
	
	public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
	
	public static function generateCode()
    {
        $query = ProjectPurchase::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'PO/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }
	
	public function projectPurchaseProduct()
    {
        return $this->hasMany('App\Models\ProjectPurchaseProduct');
    }
	
	public function projectPurchaseProduction()
    {
        return $this->hasMany('App\Models\ProjectProduction');
    }
	
	public function projectPurchasePayment()
    {
        return $this->hasMany('App\Models\ProjectPayment');
    }
	
	public function getTotal()
	{
		$project = ProjectPurchase::find($this->id);
		
		$total = 0;
		
		foreach($project->projectPurchaseProduct as $key => $pp){
			if($pp->product->type->category->parent()->parent()->slug == 'tile'){
				$m2 = (( $pp->product->type->length * $pp->product->type->width ) / 10000) * $pp->product->carton_pcs;
				$total += $pp->price * $pp->qty * $m2;
			}
			
			if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
				$total += $pp->price * $pp->qty;
			}
		}
		
		return number_format($total,2,',','.');
	}
}
