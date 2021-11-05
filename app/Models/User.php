<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasFactory, SoftDeletes, Notifiable;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'photo',
		'sign',
        'name',
        'email',
        'password',
        'branch',
		'place_of_birth',
		'date_of_birth',
		'gender',
		'marital_status',
		'blood_type',
		'religion',
		'id_type',
		'id_no',
		'postcode',
		'address_id',
		'address_residence',
		'npwp',
		'ispkp',
		'ptkp_type',
		'tax_type',
		'account_number',
		'account_bank',
		'account_name',
        'verification',
        'token_device',
        'status'
    ];
	
	public function tax_type()
	{
		switch($this->tax_type) {
            case '1':
                $tax_type = 'Gross';
                break;
            case '2':
                $tax_type = 'Gross Up';
                break;
			case '3':
                $tax_type = 'Netto';
                break;
            default:
                $tax_type = 'Invalid';
                break;
        }

        return $tax_type;
	}
	
	public function ispkp()
	{
		switch($this->ispkp) {
            case '1':
                $ispkp = 'Yes';
                break;
            case '2':
                $ispkp = 'No';
                break;
            default:
                $ispkp = 'Invalid';
                break;
        }

        return $ispkp;
	}
	
	public function id_type()
	{
		switch($this->id_type) {
            case '1':
                $id_type = 'KTP';
                break;
            case '2':
                $id_type = 'SIM';
                break;
            default:
                $id_type = 'Invalid';
                break;
        }

        return $id_type;
	}
	
	public function religion()
	{
		switch($this->religion) {
            case '1':
                $religion = 'Islam';
                break;
            case '2':
                $religion = 'Kristen';
                break;
			case '3':
                $religion = 'Katolik';
                break;
			case '4':
                $religion = 'Hindu';
                break;
			case '5':
                $religion = 'Budha';
                break;
            default:
                $religion = 'Invalid';
                break;
        }

        return $religion;
	}

	public function gender()
	{
		switch($this->gender) {
            case '1':
                $gender = 'Male';
                break;
            case '2':
                $gender = 'Female';
                break;
            default:
                $gender = 'Invalid';
                break;
        }

        return $gender;
	}
	
	public function marital_status()
	{
		switch($this->marital_status) {
            case '1':
                $marital_status = 'Single';
                break;
            case '2':
                $marital_status = 'Married';
                break;
			case '3':
                $marital_status = 'Widow';
                break;
			case '4':
                $marital_status = 'Widower';
                break;
			case '5':
                $marital_status = 'Divorced';
                break;
            default:
                $marital_status = 'Invalid';
                break;
        }

        return $marital_status;
	}

    public function branch() 
    {
        switch($this->branch) {
            case '1':
                $branch = 'Surabaya';
                break;
            case '2':
                $branch = 'Jakarta';
                break;
            default:
                $branch = 'Invalid';
                break;
        }

        return $branch;
    }

    public function status() 
    {
        switch($this->status) {
            case '1':
                $status = '<span class="text-success font-weight-bold">Active</span>';
                break;
            case '2':
                $status = '<span class="text-danger font-weight-bold">Not Active</span>';
                break;
            default:
                $status = '<span class="text-warning font-weight-bold">Invalid</span>';
                break;
        }

        return $status;
    }

    public function userRole()
    {
        return $this->hasMany('App\Models\UserRole');
    }

}
