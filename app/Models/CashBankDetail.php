<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBankDetail extends Model {

    use HasFactory;

    protected $table      = 'cash_bank_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'cash_bank_id',
        'debit',
        'credit',
        'nominal'
    ];

    public function coaDebit()
    {
        return $this->belongsTo('App\Models\Coa', 'debit', 'id');
    }

    public function coaCredit()
    {
        return $this->belongsTo('App\Models\Coa', 'credit', 'id');
    }

}
