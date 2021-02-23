<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $table = 'designs';
    protected $fillable = [
        'name',
        'type_id',
        'description',
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/products/designs/' . $val) : "";

    }

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }








}
