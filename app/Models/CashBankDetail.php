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
        'coa_id',
        'nominal'
    ];

    public function coa()
    {
        return $this->belongsTo('App\Models\Coa');
    }

}
