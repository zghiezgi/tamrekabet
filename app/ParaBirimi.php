<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParaBirimi extends Model
{
    //
    protected $table = 'para_birimleri';
    
    public function ilanlar()
    {
        return $this->hasMany('App\Ilan', 'para_birimi_id', 'id');
    }
   
}
