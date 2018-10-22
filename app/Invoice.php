<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = [
        'status',
        'delivery_date'
    ];

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function addressBook() {
        return $this->hasOne('App\AddressBook', 'id', 'address_book_id');
    }
}
