<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currentmonth extends Model
{
    protected $fillable = [
        'offer_id',
        'email',
        'is_site_active',
    ];
}
