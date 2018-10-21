<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedCategory extends Model
{
    protected $table = 'featured_category';

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'status'
    ];

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
