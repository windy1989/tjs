<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budgeting extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'budgetings';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
		'project_id',
        'coa_id',
        'month',
        'nominal'
    ];

	public function project()
    {
        return $this->belongsTo('App\Models\Project'); 
    }

    public function coa()
    {
        return $this->belongsTo('App\Models\Coa');
    }

}
