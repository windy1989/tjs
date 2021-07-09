<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'vouchers';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'code',
        'name',
        'minimum',
        'maximum',
        'quota',
        'start_date',
        'finish_date',
        'terms',
        'type'
    ];

    public function order()
    {
        return $this->hasMany('order')->where('status', '!=', 6);
    }

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Discount';
                break;
            case '2':
                $type = 'Cashback';
                break;
            case '3':
                $type = 'Shipping';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

}
