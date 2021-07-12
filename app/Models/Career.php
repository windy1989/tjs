<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model {

    use HasFactory;

    protected $table      = 'careers';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'title',
        'description',
        'requirements',
        'deadline'
    ];

    public function status() 
    {
        if(strtotime('now') <= strtotime($this->deadline)) {
            $status = '<span class="text-success font-weight-bold">Open</span>';
        } else {
            $status = '<span class="text-danger font-weight-bold">Close</span>';
        }

        return $status;
    }

}
