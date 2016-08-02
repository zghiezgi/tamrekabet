<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firmalar';
    
    public function sektorler()
    {
        return $this->belongsToMany('App\Sektor', 'firma_sektorler', 'firma_id', 'sektor_id');
    }
    public function faaliyetler()
    {
        return $this->belongsToMany('App\Faaliyet', 'firma_faaliyetler', 'firma_id', 'faaliyet_id');
    }
    public function departmanlar()
    {
        return $this->belongsToMany('App\Departman', 'firma_departmanlar', 'firma_id', 'departman_id');
    }
    public function satilan_markalar()
    {
        return $this->belongsToMany('App\SatilanMarka', 'firma_satilan_markalar', 'firma_id', 'sat_marka_id');
    }
    public function kalite_belgeleri()
    {
        return $this->belongsToMany('App\KaliteBelgesi', 'firma_kalite_belgeleri', 'firma_id', 'belge_id')->withPivot('belge_no');
    }
    public function uretilen_markalar()
    {
        return $this->hasMany('App\UretilenMarka', 'firma_id', 'id');
    }
    public function firma_referanslar()
    {
        return $this->hasMany('App\FirmaReferans', 'firma_id', 'id');
    }
    public function firma_brosurler()
    {
        return $this->hasMany('App\FirmaBrosur', 'firma_id', 'id');
    }
    public function mali_bilgiler()
    {
        return $this->hasOne('App\MaliBilgi', 'firma_id', 'id');
    }
    public function ticari_bilgiler()
    {
        return $this->hasOne('App\TicariBilgi', 'firma_id', 'id');
    }
    public function iletisim_bilgileri()
    {
        return $this->hasOne('App\IletisimBilgisi', 'firma_id', 'id');
    }
    public function firma_calisma_bilgileri()
    {
        return $this->hasOne('App\FirmaCalismaBilgisi', 'firma_id', 'id');
    }    
    public function adresler()
    {
        return $this->hasMany('App\Adres', 'firma_id', 'id');
    }
    
    
    
    
}
