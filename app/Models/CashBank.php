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
        'debit',
        'credit',
        'nominal',
        'date',
        'type',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }

    public function coaDebit()
    {
        return $this->belongsTo('App\Models\Coa', 'debit', 'id');
    }

    public function coaCredit()
    {
        return $this->belongsTo('App\Models\Coa', 'credit', 'id');
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
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

}
