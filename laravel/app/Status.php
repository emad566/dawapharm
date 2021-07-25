<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'sName',
    ];
    
    public function customers(){
        return $this->hasMany('App\Customer')->orderBy('id', 'DESC');
    }
}


