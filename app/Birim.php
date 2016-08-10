<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
    //
     protected $table = 'birimler';
     
     public function ilan_mallar()
    {
        return $this->hasMany('App\IlanMal', 'birim_id', 'id');
    }
     public function ilan_hizmetler()
    {
        return $this->hasMany('App\IlanHizmet', 'birim_id', 'id');
    }
     public function ilan_yapim_islari()
    {
        return $this->hasMany('App\IlanYapimIsi', 'birim_id', 'id');
    }
    
}
