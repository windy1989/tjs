<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPay extends Model {

    use HasFactory;

    protected $table      = 'project_pays';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'image',
        'date',
        'nominal',
        'payment',
        'payment_method'
    ];

    public function payment() 
    {
        switch($this->payment) {
            case '1':
                $payment = 'DP';
                break;
            case '2':
                $payment = 'Non DP';
                break;
            default:
                $payment = 'Invalid';
                break;
        }

        return $payment;
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

}
