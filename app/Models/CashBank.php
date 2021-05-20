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

    public static function generateCode($type)
    {
        $query = CashBank::selectRaw('RIGHT(code, 3) as code')
            ->orderByDesc('id')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $code = (int)$query[0]->code + 1;
        } else {
            $code = '001';
        }

        if($type == 1) {
            $str_type = 'CASH';
        } else if($type == 2) {
            $str_type = 'BANK';
        } else if($type == 3) {
            $str_type = 'JOURNAL';
        }

        return $str_type . '-' . date('my') . '-' . str_pad($code, 3, 0, STR_PAD_LEFT);
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
