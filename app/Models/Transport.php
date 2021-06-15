<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transport extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'transports';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'plat_number',
        'brand',
        'type'
    ];

    public function type() 
    {
        switch($this->type) {
            case '1':
                $type = 'Tronton';
                break;
            case '2':
                $type = 'Double';
                break;
            case '3':
                $type = 'Trailer';
                break;
            case '4':
                $type = 'Flat Bed';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

}
