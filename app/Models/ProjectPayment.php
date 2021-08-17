<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model {

    use HasFactory;

    protected $table      = 'project_payments';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'image',
        'date',
        'nominal',
        'bank',
        'status'
    ];

    public function bank() 
    {
        switch($this->bank) {
            case '1':
                $bank = 'BCA';
                break;
            case '2':
                $bank = 'Mandiri';
                break;
            case '3':
                $bank = 'OCBC';
                break;
            case '4':
                $bank = 'BRI';
                break;
            case '5':
                $bank = 'Danamon';
                break;
            case '6':
                $bank = 'Bukopin';
                break;
            default:
                $bank = 'Invalid';
                break;
        }

        return $bank;
    }

    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = 'Down Payment';
                break;
            case '2':
                $status = 'Full Payment';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }

}
