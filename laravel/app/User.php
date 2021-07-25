<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function isSupperAdmin(){
        if($this->role_id==1){
            return true;
        }else{
            return false;
        }
    }
    
    public function isAdmin(){
        if($this->role_id==1 || $this->role_id==2){
            return true;
        }else{
            return false;
        }
    }

}
