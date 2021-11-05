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
        'type',
        'nominal',
        'note'
    ];

    public function coa()
    {
        return $this->belongsTo('App\Models\Coa');
    }
	
	public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Debit';
                break;
            case '2':
                $type = 'Credit';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }
}
