<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //
    protected $table = 'login';
    
    public function kullanicilar()
    {
        return $this->belongsTo('App\Kullanici', 'kullanici_id', 'id');
    }
   
}
