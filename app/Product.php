<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'brand_id',
        'category_id',
        'item_code',
        'product_price',
        'critical_value',
        'description',
        'specification',
        'image',
        'deleted_at'
    ];

    public function brand() {
        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
