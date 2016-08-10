<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IlanHizmet extends Model
{
    //
     protected $table = 'ilan_hizmetler';
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
     public function fiyat_birimler()
    {
        return $this->belongsTo('App\Birim', 'fiyat_standardi_birim_id', 'id');
    }
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
    
}
