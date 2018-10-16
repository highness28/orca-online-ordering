<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [
        'product_id',
        'quantity',
        'status'
    ];

    public function product() {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
