<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProjectSale extends Model {

    use HasFactory;

    protected $table      = 'project_sales';
    protected $primaryKey = 'id';
    protected $fillable   = [
		'user_id',
        'project_id',
		'sales_id',
        'code',
		'address',
		'note',
		'so_file',
        'marketing_by',
        'approved_by',
		'delivery_cost',
		'cutting_cost',
		'misc_cost'
    ];
	
	public function attachment() 
    {
        if(Storage::exists($this->so_file)) {
            $attachment = asset(Storage::url($this->so_file));
        } else {
            $attachment = asset('website/empty.jpg');
        }

        return $attachment;
    }
	
	public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	public function sales()
    {
        return $this->belongsTo('App\Models\User', 'sales_id', 'id');
    }
	
	public function marketing()
    {
        return $this->belongsTo('App\Models\User', 'marketing_id', 'id');
    }
	
	public function approved()
    {
        return $this->belongsTo('App\Models\User', 'approved_id', 'id');
    }
	
	public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
	
	public static function generateCode()
    {
        $query = ProjectSale::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'SO/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }
	
	public function projectSaleProduct()
    {
        return $this->hasMany('App\Models\ProjectSaleProduct');
    }
	
	public function projectSaleShading()
    {
        return $this->hasMany('App\Models\ProjectSaleShading');
    }
	
	public function projectSalePay()
    {
        return $this->hasMany('App\Models\ProjectPay');
    }
	
	public function getTotal()
	{
		$project = ProjectSale::find($this->id);
		
		$total = 0;
		
		foreach($project->projectSaleProduct as $key => $pp){
			if($pp->product->type->category->parent()->parent()->slug == 'tile'){
				$m2 = (( $pp->product->type->length * $pp->product->type->width ) / 10000) * $pp->product->carton_pcs;
				$countbox = ceil($pp->qty / $m2);
				$total += $pp->best_price * $m2 * $countbox;
			}
			
			if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
				$total += $pp->best_price * $pp->qty;
			}
		}
		
		if($project->project->ppn == '1'){
			return number_format(($total + $project->delivery_cost + $project->cutting_cost + $project->misc_cost) + (0.1 * ($total + $project->delivery_cost + $project->cutting_cost + $project->misc_cost)),2,',','.');
		}else{
			return number_format($total + $project->delivery_cost + $project->cutting_cost + $project->misc_cost,2,',','.');
		}
		
	}
}
