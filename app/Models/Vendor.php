<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    protected $table = 'vendors';
    protected $fillable = [
        'company_name',
        'location',
        'commercial_registration_No',
        'mobile_No',
        'national_Id',
        'email',
        'type_activity',
        'password',
        'created_at',
        'updated_at'
    ];

}
