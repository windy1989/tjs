<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $table      = 'banks';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'code',
        'name',
        'address',
		'branch',
        'account_number',
		'bank_swift_code',
        'status'
    ];

    public function status() 
    {
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
