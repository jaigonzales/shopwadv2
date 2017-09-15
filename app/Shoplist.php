<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoplist extends Model
{
    
    protected $fillable = [
        'user_id', 'title', 'desc', 'privacy'
    ];
}
