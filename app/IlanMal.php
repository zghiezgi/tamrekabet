<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IlanMal extends Model
{
    //
     protected $table = 'ilan_mallar';
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
      public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
}
