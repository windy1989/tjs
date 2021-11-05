<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'journals';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'journalable_type',
        'journalable_id',
        'coa_id',
        'type',
        'nominal',
    ];

    public function journalable()
    {
        return $this->morphTo();
    }
	
	public function coa()
    {
        return $this->belongsTo('App\Models\Coa');
    }

}
