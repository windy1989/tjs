<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashBank extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'cash_banks';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'user_id',
		'project_id',
		'project_detail_id',
		'reference',
        'code',
        'date',
        'type',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }
	
	public function project()
    {
        return $this->belongsTo('App\Models\Project'); 
    }
	
	public function projectSale()
    {
        return $this->belongsTo('App\Models\ProjectSale','project_detail_id','id'); 
    }
	
	public function projectPurchase()
    {
        return $this->belongsTo('App\Models\ProjectPurchase','project_detail_id','id'); 
    }
	
	public function sum(){
		$cashbank = CashBank::find($this->id);
		
		$total = $cashbank->cashBankDetail()->where('type','1')->sum('nominal');
		
		return $total;
	}

    public function cashBankDetail()
    {
        return $this->hasMany('App\Models\CashBankDetail'); 
    }

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Cash / Bank In';
                break;
            case '2':
                $type = 'Cash / Bank Out';
                break;
            case '3':
                $type = 'Journal';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }
	
	public function reference() 
    {
        switch($this->reference) {
            case '1':
                $reference = 'Sales';
                break;
            case '2':
                $reference = 'Purchase';
                break;
            default:
                $reference = 'Invalid';
                break;
        }

        return $reference;
    }

}
