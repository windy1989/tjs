<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use HasFactory;

    protected $table      = 'orders';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'customer_id',
        'xendit',
        'qr_code',
        'number',
        'code',
        'discount',
        'subtotal',
        'shipping',
        'grandtotal',
        'payment',
        'change',
        'description',
        'type',
        'status'
    ];

    public function xendit()
    {
        return json_decode($this->xendit);
    }

    public static function generateNumber($param)
    {
        return 'SMB' . $param . date('ymdHis');
    }

    public static function generateCode($param)
    {
        $query = Order::selectRaw('RIGHT(code, 6) as code')
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return 'INV/' . $param . '/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Cash';
                break;
            case '2':
                $type = 'Cashless';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = 'Unpaid';
                break;
            case '2':
                $status = 'Paid';
                break;
            case '3':
                $status = 'Packed';
                break;
            case '4':
                $status = 'Delivery';
                break;
            case '5':
                $status = 'Finish';
                break;
            case '6':
                $status = 'Cancel';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function orderShipping()
    {
        return $this->hasOne('App\Models\OrderShipping');
    }

    public function orderPayment()
    {
        return $this->hasOne('App\Models\OrderPayment');
    }

}
