<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'terms_conditions',
        'created_at',
        'updated_at'
    ];
}
