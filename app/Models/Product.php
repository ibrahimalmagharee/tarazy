<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'price',
        'offer_id',
        'vendor_id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function design()
    {
        return $this->morphTo();
    }
    public function fabric()
    {
        return $this->morphTo();
    }

}
