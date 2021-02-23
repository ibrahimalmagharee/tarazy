<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    protected $table = 'fabrics';
    protected $fillable = [
        'name',
        'color_id',
        'description',
        'created_at',
        'updated_at'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/products/fabrics/' . $val) : "";

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
