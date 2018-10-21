<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public function account() {
        return $this->hasOne('App\CustomerAccount', 'customer_id', 'id');
    }
}
