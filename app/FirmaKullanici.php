<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaKullanici extends Model
{
    //
    protected $table = 'firma_kullanicilar';
    
    public function roller()
    {
        return $this->belongsTo('App\Rol', 'rol_id', 'id');
    }
    
   
}
