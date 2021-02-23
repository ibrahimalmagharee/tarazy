<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'is_active',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeChild($query)
    {
        return  $query -> whereNotNull('parent_id');
    }

    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function scopeParent($query)
    {
        return  $query -> whereNull('parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('categories');
    }
}
