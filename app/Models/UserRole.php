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
                $role = 'CMO';
                break;
            case '3':
                $role = 'Secretary';
                break;
            case '4':
                $role = 'Finance';
                break;
            case '5':
                $role = 'Accounting';
                break;
            case '6':
                $role = 'Retail Manager';
                break;
            case '7':
                $role = 'Sales Manager';
                break;
            case '8':
                $role = 'Sales Project';
                break;
            case '9':
                $role = 'Administration';
                break;
            case '10':
                $role = 'Digital Marketing';
                break;
            case '11':
                $role = 'Purchase';
                break;
            case '12':
                $role = 'Admin Sales / Stock';
                break;
            case '13':
                $role = 'AR & Delivery';
                break;
            case '14':
                $role = 'After Sales';
                break;
            default:
                $role = 'Invalid';
                break;
        }

        return $role;
    }

}
