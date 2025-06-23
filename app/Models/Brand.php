<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = false;

    /**
     * Relationship: Brand has many Products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
