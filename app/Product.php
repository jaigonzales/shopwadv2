<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'user_id',
        'shoplist_id',
        'product_name',
        'product_url',
        'size',
        'color',
        'quantity'
    ];
}
