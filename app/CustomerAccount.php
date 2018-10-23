<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerAccount extends Model
{
    use Notifiable;
    
    protected $table = 'customer_account';
}
