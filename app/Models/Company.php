<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'companies';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'code',
        'name',
        'status'
    ];

    public function status() {
        switch($this->status) {
            case '1':
                $status = '<span class="text-success">Active</span>';
                break;
            case '2':
                $status = '<span class="text-danger">Not Active</span>';
                break;
            default:
                $status = '<span class="text-warning">Invalid</span>';
                break;
        }

        return $status;
    }

}
