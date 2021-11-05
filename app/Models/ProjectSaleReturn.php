<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProjectSaleReturn extends Model {

    use HasFactory;

    protected $table      = 'project_sale_returns';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
		'project_id',
        'project_sale_id',
        'code',
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
        $query = ProjectSaleReturn::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'SR/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }
	
	public function projectSale()
    {
        return $this->belongsTo('App\Models\ProjectSale','project_sale_id','id');
    }
	
	public function projectSaleReturnProduct()
    {
        return $this->hasMany('App\Models\ProjectSaleReturnProduct');
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
