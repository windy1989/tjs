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
        'step',
        'number',
        'invoice',
        'sales_order',
        'purchase_order',
        'delivery_order',
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

    public static function generateCode($param, $column)
    {
        $query = Order::selectRaw("RIGHT($column, 6) as code")
            ->orderByDesc('id')
            ->limit(1)
            ->get();

        if($column == 'invoice') {
            $str = 'INV';
        } else if($column == 'sales_order') {
            $str = 'SO';
        } else if($column == 'purchase_order') {
            $str = 'PO';
        } else if($column == 'delivery_order') {
            $str = 'DO';
        } 

        if($query->count() > 0) {
            $number = (int)$query[0]->code + 1;
        } else {
            $number = '0001';
        }

        $code = str_pad($number, 6, 0, STR_PAD_LEFT);
        return $str . '/' . $param . '/' . date('y') . '/' . date('m') . '/' . date('d') . '/' . $code;
    }

    public function step() 
    {
        switch($this->step) {
            case '1':
                $step = 'Sales Order';
                break;
            case '2':
                $step = 'Sales Order Approval';
                break;
            case '3':
                $step = 'Purchase Order';
                break;
            case '4':
                $step = 'Invoice';
                break;
            case '5':
                $step = 'Delivery Order';
                break;
            default:
                $step = 'Invalid';
                break;
        }

        return $step;
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
