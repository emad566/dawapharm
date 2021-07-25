<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'offerName',
        'offerMonth',
        'offerMonth',
        'minPrice',
        'minPriceOrder',
        'minPricePrecent',
        'discount', //%
        'offerPrice',
        'orderPrice',
        'expireTotal',
        'charge',
        'tolerance',
        'thumb',
        'desc',
    ];

    public function products($id="")
    {
        if($id){
            return $this->belongsToMany('App\Product')->withTimestamps()->withPivot([
                'offerPriority',
                'is_offer',
                'expiredPriority',
                'is_expired'
            ])->wherePivot('product_id', $id);
        }else{
            return $this->belongsToMany('App\Product')->withTimestamps()->withPivot([
                'offerPriority',
                'is_offer',
                'expiredPriority',
                'is_expired'
            ]);
        }
    }

    public function customers(){
        return $this->hasMany('App\Customer')->orderBy('id', 'DESC');
    }
}
