<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Firma;
use App\Il;
class FirmaIlanController extends Controller
{
    //
     public function showFirmaIlan($id){
        $firma = Firma::find($id);
        $sektorler= \App\ Sektor::all();
        $maliyetler=  \App\Maliyet::all();
        $odeme_turleri= \App\OdemeTuru::all();
        $para_birimleri= \App\ParaBirimi::all();
        $iller = Il::all();
        /*
        
        $sirketTurleri=  SirketTuru::all();
        $vergiDaireleri= \App\VergiDairesi::all();
        $ticaretodasi=  \App\TicaretOdasi::all();
       
        $departmanlar=  \App\Departman::all();
        $markalar=  \App\SatilanMarka::all();
        $faaliyetler= \App\Faaliyet::all();
        $kalite_belgeleri= \App\KaliteBelgesi::all();
        $calisma_günleri= \App\CalismaGunu::all();
        */
        return view('Firma.ilan.firmailan', ['firma' => $firma])->with('iller',$iller)->with('sektorler',$sektorler)->with('maliyetler',$maliyetler)->with('odeme_turleri',$odeme_turleri)->with('para_birimleri',$para_birimleri) ;//->with('sirketTurleri',$sirketTurleri)->with('vergiDaireleri',$vergiDaireleri)->with('ticaretodasi',$ticaretodasi)->with('departmanlar',$departmanlar)->with('markalar',$markalar)->with('faaliyetler',$faaliyetler)->with('kalite_belgeleri',$kalite_belgeleri)->with('calisma_günleri',$calisma_günleri);
    }
     public function firmaBilgilerimAdd(Request $request,$id){
        $firma = Firma::find($request->id);
          
        $firma->adi = $request->firma_adi;
        $firma->goster = $request->firma_adi_gizli;
        $firma->save();
        
        $sektor = $firma->sektorler ?: new \App\Sektor();
        $sektor->adi=$request->firma_sektor;
        $firma->sektorler()->attach($sektor);
        return redirect('/firmaIlanOlustur/'.$firma->id);
   
         
     }
     public function ilanAdd(Request $request,$id){
     $firma = Firma::find($request->id);
     $ilan= $firma->ilanlar ?: new \App\Ilan();
     
      $ilan->adi= $request->ilan_adi;
      $ilan->yayin_tarihi= $request->yayinlama_tarihi;
      $ilan->kapanma_tarihi= $request->kapanma_tarihi;
      $ilan->aciklama = $request->aciklama;
      $ilan->ilan_turu= $request->ilan_turu;
      $ilan->usulu= $request->ilan_usulu;
      $ilan->sozlesme_turu= $request->sozlesme_turu;
      $ilan->teknik_sartname= $request->teknik_sartname;
      $ilan->yaklasik_maliyet_id= $request->yaklasik_maliyet;
      $ilan->teslim_yeri_satici_firma= $request->teslim_yeri;
      $ilan->teslim_yeri_il_id= $request->il_id;
      $ilan->teslim_yeri_ilce_id= $request->ilce_id;
      $ilan->isin_suresi= $request->isin_suresi;
      $ilan->is_baslama_tarihi= $request->is_baslama_tarihi;
      $ilan->is_bitis_tarihi= $request->is_bitis_tarihi;
      $ilan->adi= $request->ilan_adi;
      $firma->ilanlar()->save($ilan);
      
     
      
      return redirect('/firmaIlanOlustur/'.$firma->id);   
     }
     public function fiyatlandırmaBilgileriAdd(Request $request,$id){
         $firma = Firma::find($request->id);
         $ilan= $firma->ilanlar ?: new \App\Ilan();
         
         $ilan->kdv_dahil=$request->kdv;
         $ilan->odeme_turu_id=$request->odeme_turu;
         $ilan->para_birimi_id=$request->para_birimi;
         $firma->ilanlar()->save($ilan);
         
         return redirect('/firmaIlanOlustur/'.$firma->id);
         
     }
    
    
    
    
    
    
    
}
