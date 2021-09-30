<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'customers';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable   = [
        'photo',
        'name',
        'constructor',
        'email',
        'phone',
        'password',
        'type',
        'points',
        'verification'
    ];

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = '<span class="text-success font-weight-bold">Online</span>';
                break;
            case '2':
                $type = '<span class="text-danger font-weight-bold">Offline</span>';
                break;
            case '3':
                    $type = '<span class="text-info font-weight-bold">Hybrid</span>';
                    break;
            default:
                $type = '<span class="text-warning font-weight-bold">Invalid</span>';
                break;
        }

        return $type;
    }

    public function photo()
    {
        if(Storage::exists($this->photo)) {
            $photo = asset(Storage::url($this->photo));
        } else if($this->photo) {
            $photo = $this->photo;
        } else {
            $photo = asset('website/user.png');
        }

        return $photo;
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

}
