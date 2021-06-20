<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model {

    use HasFactory;

    protected $table      = 'approvals';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'approvalable_type',
        'approvalable_id',
        'reference',
        'approved_by',
        'seen',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function references()
    {
        return $this->belongsTo('App\Models\User', 'reference');
    }

    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User', 'approved_by');
    }

    public function approvalable()
    {
        return $this->morphTo();
    }

    public function type() 
    {
        switch($this->approvalable_type) {
            case 'orders':
                $type = 'Order';
                break;
            case 'projects':
                $type = 'Project';
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
                $status = 'Need Approval';
                break;
            case '2':
                $status = 'Approval';
                break;
            case '3':
                $status = 'Rejected';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }

}
