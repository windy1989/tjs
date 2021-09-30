<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasFactory, SoftDeletes, Notifiable;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'photo',
        'name',
        'email',
        'password',
        'branch',
        'verification',
        'token_device',
        'status'
    ];

    public function branch() 
    {
        switch($this->branch) {
            case '1':
                $branch = 'Surabaya';
                break;
            case '2':
                $branch = 'Jakarta';
                break;
            default:
                $branch = 'Invalid';
                break;
        }

        return $branch;
    }

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

    public function userRole()
    {
        return $this->hasMany('App\Models\UserRole');
    }

}
