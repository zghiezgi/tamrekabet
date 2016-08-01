<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Il extends Model
{
    protected $table = 'iller';
    
    public function ilceler()
    {
        return $this->hasMany('App\ilceler', 'il_id', 'id');
    }
    public function adresler()
    {
        return $this->hasMany('App\adresler', 'il_id', 'id');
    }
}
