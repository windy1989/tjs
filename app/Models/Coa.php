<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coa extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'coas';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'code',
        'name',
        'parent_id',
        'status'
    ];

    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = '<span class="text-success font-weight-bold">Active</span>';
                break;
            case '2':
                $status = '<span class="text-danger font-weight-bold">Not Active</span>';
                break;
            default:
                $status = '<span class="text-warning font-weight-bold">Invalid</span>';
                break;
        }

        return $status;
    }

    public function parent()
    {
        $query = Coa::find($this->parent_id);
        return $query;
    }
	
	public function child()
    {
        $query = Coa::where('parent_id',$this->id)->get();
        return $query;
    }

    public function journalDebit()
    {
        return $this->hasMany('App\Models\Journal');
    }

    public function journalCredit()
    {
        return $this->hasMany('App\Models\Journal');
    }

    public function budgeting()
    {
        return $this->hasMany('App\Models\Budgeting');
    }

	public function checkBudget($month)
	{
		$query = Budgeting::where('coa_id',$this->id)->where('month',$month)->first();
		
		if($query){
			return number_format($query->nominal,2,',','.');
		}else{
			return 0;
		}
	}
}
