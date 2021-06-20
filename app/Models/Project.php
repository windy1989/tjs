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
        'email',
        'phone',
        'timeline',
        'constructor',
        'manager',
        'consultant',
        'owner',
        'payment_method',
        'supply_method',
        'ppn',
        'progress'
    ];

    public static function generateCode()
    {
        $query = Project::selectRaw("RIGHT(code, 6) as code")
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'PT/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }

    public function paymentMethod() 
    {
        switch($this->payment_method) {
            case '1':
                $payment_method = 'Giro';
                break;
            case '2':
                $payment_method = 'SKBDN';
                break;
            case '3':
                $payment_method = 'DP';
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

}
