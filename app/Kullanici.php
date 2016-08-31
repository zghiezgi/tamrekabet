<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kullanici extends Model
{
    //
    protected $table = 'kullanicilar';
    public $timestamps=false;
    public function login()
    {
        return $this->hasOne('App\Login', 'kullanici_id', 'id');
    }
    public function firmalar()
    {
        return $this->belongsToMany('App\Firma','firma_kullanicilar', 'kullanici_id', 'firma_id');
    }
    
   
}
