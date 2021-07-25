<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'p_name',
        'p_active_ingredient',
        'p_price',
        'sort_factor',
    ];

    public function offers()
    {
        return $this->belongsToMany('App\Offer')->withTimestamps();
    }

    public function customers()
    {
        return $this->belongsToMany('App\Customer')->withPivot('amount', 'offer_id', 'amountPrice', 'amountPrice')->withTimestamps();
    }

}
