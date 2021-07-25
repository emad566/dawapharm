<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    protected $fillable = [
        'customer_id',
        'offer_id',
        'product_id',
        'amount',
        'amountPrice',

    ];
}
