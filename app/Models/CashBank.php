<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBank extends Model {

    use HasFactory;

    protected $table      = 'cash_banks';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'code',
        'date',
        'type',
        'description'
    ];

    public static function generateCode($type, $date)
    {
        if($type == 1) {
            $total_str = 4;
            $str_type  = 'CASH';
        } else if($type == 2) {
            $total_str = 4;
            $str_type  = 'BANK';
        } else if($type == 3) {
            $total_str = 7;
            $str_type  = 'JOURNAL';
        }

        $query = CashBank::selectRaw("RIGHT(code, 3) as code")
            ->whereMonth('date', date('m', strtotime($date)))
            ->whereYear('date', date('Y', strtotime($date)))
            ->whereRaw("LEFT(code, $total_str) = ?", [$str_type])
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $code = (int)$query[0]->code + 1;
        } else {
            $code = '001';
        }


        return $str_type . '-' . date('my', strtotime($date)) . '-' . str_pad($code, 3, 0, STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }

    public function cashBankDetail()
    {
        return $this->hasMany('App\Models\CashBankDetail'); 
    }

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Cash';
                break;
            case '2':
                $type = 'Bank';
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

}
