<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'country_id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'pic',
        'limit_credit',
        'term_of_payment',
        'status'
    ];

    public function status() {
        switch($this->status) {
            case '1':
                $status = '<span class="text-success font-weight-bold">Active</span>';
                break;
            case '2':
                $status = '<span class="text-danger font-weight-bold">Not Active</span>';
                break;
            default:
                $status = '<span class="text-warning font-weight-bold">Invalid</span>';
                break;
        }

        return $status;
    }

}
