<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectSample extends Model {

    use HasFactory;

    protected $table      = 'project_samples';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'project_id',
        'product_id',
        'date',
        'qty',
        'size'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
