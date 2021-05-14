<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {

    use HasFactory;

    protected $table      = 'user_roles';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'role'
    ];

    public function role() 
    {
        switch($this->role) {
            case '1':
                $role = 'Director';
                break;
            case '2':
                $role = 'Secretary';
                break;
            case '3':
                $role = 'Head Of Finance';
                break;
            case '4':
                $role = 'Head Of Accounting';
                break;
            case '5':
                $role = 'Sales & Marketing Manager';
                break;
            case '6':
                $role = 'Sales Project';
                break;
            case '7':
                $role = 'Head Of Administration';
                break;
            case '8':
                $role = 'Digital Marketing';
                break;
            case '9':
                $role = 'Purchasing';
                break;
            case '10':
                $role = 'Admin Sales & Stock';
                break;
            case '11':
                $role = 'Piutang & Pengiriman';
                break;
            case '12':
                $role = 'Assisten Hiro';
                break;
            case '13':
                $role = 'Assisten';
                break;
            default:
                $role = 'Invalid';
                break;
        }

        return $role;
    }

}
