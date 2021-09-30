<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model {

    use HasFactory;

    protected $table      = 'projects';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'country_id',
        'city_id',
        'code',
        'name',
        'customer_id',
        'timeline',
        'manager',
        'consultant',
        'owner',
		'coa_id',
        'payment_method',
        'supply_method',
        'ppn',
        'progress',
		'so_file',
		'delivery_cost',
		'cutting_cost',
		'misc_cost'
    ];

    public static function generateCode()
    {
        $query = Project::selectRaw("RIGHT(code, 6) as code")
            ->orderByRaw('RIGHT(code, 6) DESC')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'PJ/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }

    public function paymentMethod() 
    {
        switch($this->payment_method) {
            case '1':
                $payment_method = 'Cash';
                break;
            case '2':
                $payment_method = 'Credit';
                break;
            default:
                $payment_method = 'Invalid';
                break;
        }

        return $payment_method;
    }

    public function supplyMethod() 
    {
        switch($this->supply_method) {
            case '1':
                $supply_method = 'Full';
                break;
            case '2':
                $supply_method = 'Partial';
                break;
            default:
                $supply_method = 'Invalid';
                break;
        }

        return $supply_method;
    }

    public function ppn() 
    {
        switch($this->ppn) {
            case '1':
                $ppn = 'Yes';
                break;
            case '0':
                $ppn = 'No';
                break;
            default:
                $ppn = 'Invalid';
                break;
        }

        return $ppn;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
	
	public function coa()
    {
        return $this->belongsTo('App\Models\Coa');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function projectProduct()
    {
        return $this->hasMany('App\Models\ProjectProduct');
    }

    public function projectConsultantMeeting()
    {
        return $this->hasMany('App\Models\ProjectConsultantMeeting');
    }

    public function projectSample()
    {
        return $this->hasMany('App\Models\ProjectSample');
    }

    public function projectPayment()
    {
        return $this->hasMany('App\Models\ProjectPayment');
    }

    public function projectProduction()
    {
        return $this->hasMany('App\Models\ProjectProduction');
    }

    public function projectShipment()
    {
        return $this->hasOne('App\Models\ProjectShipment');
    }

    public function projectDelivery()
    {
        return $this->hasOne('App\Models\ProjectDelivery');
    }

    public function projectPay()
    {
        return $this->hasOne('App\Models\ProjectPay');
    }
	
	public function projectWarehouse()
    {
        return $this->hasMany('App\Models\ProjectWarehouse');
    }
	
	public function projectQuotation()
    {
        return $this->hasMany('App\Models\ProjectQuotation');
    }
}
