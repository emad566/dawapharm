<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'title',
        'whats',
        'total', //expiredTotal 	
        'offerTotal',
        'offer_id',
        'status_id',
        'notes',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('amount', 'offer_id', 'amountPrice')->withTimestamps();
    }

    public function offer(){
        return $this->belongsTo('App\Offer');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }
}
