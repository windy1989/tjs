<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashBank extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'cash_banks';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'image',
        'user_id',
        'code',
        'date',
        'type',
        'description'
    ];

    public function image()
    {
        if(Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/empty.jpg');
        }

        return $image;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }

    public function cashBankDetail()
    {
        return $this->hasMany('App\Models\CashBankDetail'); 
    }

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Cash';
                break;
            case '2':
                $type = 'Bank';
                break;
            case '3':
                $type = 'Journal';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

}
