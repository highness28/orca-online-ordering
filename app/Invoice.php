<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
}
