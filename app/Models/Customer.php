<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model {

    use HasFactory;

    protected $table      = 'customers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'photo',
        'name',
        'email',
        'phone',
        'password',
        'verification'
    ];

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
