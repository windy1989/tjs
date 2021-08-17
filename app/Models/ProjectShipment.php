<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectShipment extends Model {

    use HasFactory;

    protected $table      = 'project_shipments';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'loading_date',
        'departure_date',
        'from_port',
        'to_port',
        'eta',
        'note'
    ];

}
