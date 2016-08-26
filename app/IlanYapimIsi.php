<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IlanYapimIsi extends Model
{
    //
     protected $table = 'ilan_yapim_isleri';
     public $timestamps=false;
     public function birimler()
    {
        return $this->belongsTo('App\Birim', 'birim_id', 'id');
    }
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
}
