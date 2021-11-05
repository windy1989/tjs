<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model {

    use HasFactory;

    protected $table      = 'projects';
    protected $primaryKey = 'id';
    protected $fillable   = [
		'id',
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
		'term_payment',
        'supply_method',
        'ppn',
        'progress',
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
            case '11':
                $payment_method = 'Cash Before Delivery';
                break;
            case '12':
                $payment_method = 'Cash After Delivery';
                break;
			case '13':
                $payment_method = 'Cash with Down Payment';
                break;
			case '21':
                $payment_method = 'Credit with Cover BG';
                break;
			case '22':
                $payment_method = 'Credit with SKBDN';
                break;
			case '23':
                $payment_method = 'Credit with SCF';
                break;
			case '24':
                $payment_method = 'Credit with Down Payment';
                break;
            default:
                $payment_method = 'Invalid';
                break;
        }

        return $payment_method;
    }
	
	public function paymentTerm() 
    {
        switch($this->term_payment) {
            case '0':
                $payment_term = 'Default (0 days)';
                break;
            case '7':
                $payment_term = '7 Days';
                break;
			case '14':
                $payment_term = '14 Days';
                break;
			case '30':
                $payment_term = '30 Days';
                break;
			case '45':
                $payment_term = '45 Days';
                break;
            default:
                $payment_term = 'Invalid';
                break;
        }

        return $payment_term;
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
	
	public function projectNegotiation()
    {
        return $this->hasMany('App\Models\ProjectNegotiation');
    }
	
	public function projectSale()
    {
        return $this->hasMany('App\Models\ProjectSale');
    }
	
	public function projectPurchase()
    {
        return $this->hasMany('App\Models\ProjectPurchase');
    }
	
	public function projectProforma()
    {
        return $this->hasMany('App\Models\ProjectProforma');
    }
	
	public function projectPurchaseReturn()
    {
        return $this->hasMany('App\Models\ProjectPurchaseReturn');
    }
	
	public function projectSaleReturn()
    {
        return $this->hasMany('App\Models\ProjectSaleReturn');
    }
	
	public function projectTroubleshooting()
    {
        return $this->hasMany('App\Models\ProjectTroubleshooting');
    }
	
	public function getApprovalQuotation()
	{
		$data = ProjectQuotation::where('project_id', $this->id)->orderByDesc('id')->first();
		return $data;
	}
}
