<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IlanGoturuBedel extends Model
{
    //
     protected $table = 'ilan_goturu_bedeller';
     public $timestamps=false;
       public function ilanlar()
    {
        return $this->belongsTo('App\Ilan', 'ilan_id', 'id');
    }
}
