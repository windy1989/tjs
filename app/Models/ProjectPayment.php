<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectPayment extends Model {

    use HasFactory;

    protected $table      = 'project_payments';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
		'project_purchase_id',
        'image',
        'date',
        'nominal',
        'bank',
        'status'
    ];

	public function projectPurchase()
    {
        return $this->belongsTo('App\Models\ProjectPurchase', 'project_purchase_id', 'id');
    }
	
	public function coa()
    {
        return $this->belongsTo('App\Models\Coa','bank','id');
    }
	
    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = 'Down Payment';
                break;
            case '2':
                $status = 'Full Payment';
                break;
            default:
                $status = 'Other';
                break;
        }

        return $status;
    }
	
	public function attachment() 
    {
        if(Storage::exists($this->image)) {
            $attachment = asset(Storage::url($this->image));
        } else {
            $attachment = asset('website/empty.jpg');
        }

        return $attachment;
    }
}
