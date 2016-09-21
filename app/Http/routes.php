<?php
use App\Form;
use App\iller;
use App\ilceler;
use App\semtler;
use App\adresler;
use App\adres_turleri;
use App\Sektor;
use App\Firma;
use App\FirmaReferans;
use App\iletisim_bilgileri;
use App\Ilan;
use Illuminate\Http\Request;


Route::get('/firmalist', ['middleware'=>'auth' ,function () {
    $firmalar = Firma::paginate(2);
    return view('Firma.firmalar')->with('firmalar', $firmalar);
}]);
Route::get('/image/{id}', ['middleware'=>'auth',function ($id) {
    $firmas = Firma::find($id);
    return view('firmas.upload')->with('firmas', $firmas);
}]);
Route::get('/', ['middleware'=>'auth',function () {
   
    return view('Anasayfa.anasayfa');
}]);
Route::get('/firmaKayit' ,function () {
    $iller = App\Il::all();
    $sektorler= App\Sektor::all();
    return view('Firma.firmaKayit')->with('iller', $iller)->with('sektorler',$sektorler);
});
Route::get('/firmaIslemleri/{id}',['middleware'=>'auth', function ($id) {
    $firma=  Firma::find($id);
    return view('Firma.firmaIslemleri')->with('firma',$firma);
}]);
Route::get('/ilanAra', function (Request $request) {
     $iller = App\Il::all();
      $sektorler= App\Sektor::all();
        $query = Ilan::all();
        //$query->orwhere('id',12)->get();
    
        
        if($request->il_id != NULL)
        {
            $matchThese = ['id' => 11];
        

            /*if ($request->il_id != null) {
                $query->firmalar->adresler->where('il_id', 'LIKE', '%' . $request->input('il_id') . '%');
            }*/
            $query = Ilan::where($matchThese)->get();
        }

        
    return view('Firma.ilan.ilanAra')->with('iller', $iller)->with('sektorler',$sektorler)->with('query',$query);
});
Route::get('/ilanAraFiltre/{il}',function ($id) {
    $query = Ilan::all();
     $il_id = Input::get('il');
     if($id != NULL)
        {
         $query = DB::table('ilanlar')
            ->where('id', $il_id)   
            ->get();
       
        }
    return Response::json($query);
    
});


Route::post('/form', function (Request $request) {
   
        $firma= new Firma();
      
        $firma->adi=$request->adi;
        $firma->save();
        
        $iletisim = $firma->iletisim_bilgileri ?: new App\IletisimBilgisi();
        $iletisim->telefon = $request->telefon;
        $firma->iletisim_bilgileri()->save($iletisim);    
        
        $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new  App\Adres();
        $adres->il_id = $request->il_id;
        $adres->ilce_id = $request->ilce_id;
        $adres->semt_id = $request->semt_id;
        $adres->adres = $request->adres;
        $tur = 1;
        $adres->tur_id = $tur;
        $firma->adresler()->save($adres);
        
        $firma->sektorler()->attach($request->sektor_id);
   

      $kullanici= new App\Kullanici();
      $kullanici->adi = $request->adi;
      $kullanici->soyadi = $request->soyadi;
      $kullanici->email = $request->email;
      $kullanici->unvani = $request->unvan;
      $kullanici->telefon = $request->telefonkisisel;

      $kullanici->save(); 

        $user = $kullanici->user ?: new App\User();
        $user->name = $request->kullanici_adi;
        $user->email = $request->email;

    $user->password =Hash::make( $request->password);
    


    $kullanici->users()->save($user);
    
    $firma->kullanicilar()->attach($kullanici);

    return redirect('/firmalist');
});


//firma profil route...
Route::post('firmaProfili/uploadImage/{id}', 'FirmaController@uploadImage');
Route::post('firmaProfili/deleteImage/{id}', 'FirmaController@deleteImage');
Route::post('firmaProfili/iletisimAdd/{id}', 'FirmaController@iletisimAdd');
Route::post('firmaProfili/tanitim/{id}', 'FirmaController@tanitimAdd');
Route::post('firmaProfili/malibilgi/{id}', 'FirmaController@maliBilgiAdd');
Route::post('firmaProfili/ticaribilgi/{id}', 'FirmaController@ticariBilgiAdd');
Route::post('firmaProfili/kalite/{id}', 'FirmaController@kaliteAdd');
Route::post('firmaProfili/kaliteGuncelle/{id}', 'FirmaController@kaliteGuncelle');
Route::post('firmaProfili/referans/{id}', 'FirmaController@referansAdd');
Route::post('firmaProfili/firmaCalisan/{id}', 'FirmaController@calisanGunleriAdd');
Route::post('firmaProfili/bilgilendirmeTercihi/{id}', 'FirmaController@bilgilendirmeTercihiAdd');
Route::post('firmaProfili/firmaBrosur/{id}', 'FirmaController@uploadPdf');
Route::post('firmaProfili/firmaBrosurGuncelle/{id}', 'FirmaController@brosurUpdate');
Route::post('firmaProfili/referansUpdate/{id}', 'FirmaController@referansUpdate');
Route::delete('firmaProfili/kaliteSil/{id}', 'FirmaController@deleteKalite');
Route::delete('firmaProfili/referansSil/{id}', 'FirmaController@deleteReferans');
Route::delete('firmaProfili/brosurSil/{id}', 'FirmaController@deleteBrosur');
Route::get('/firmaProfili/{id}', 'FirmaController@showFirma');
Route::get('/firma/{ref_id?}',function($ref_id){
    $referans=  FirmaReferans::find($ref_id);
    return Response::json($referans);

});
Route::get('/firmabrosur/{brosur_id?}',function($brosur_id){
$brosur= App\FirmaBrosur::find($brosur_id);
return Response::json($brosur);

});

//firma ilan route...
Route::get('/firmaIlanOlustur/{id}', 'FirmaIlanController@showFirmaIlan');
Route::post('firmaIlanOlustur/firmaBilgilerim/{id}', 'FirmaIlanController@firmaBilgilerimAdd');
Route::post('firmaIlanOlustur/ilanBilgileri/{id}', 'FirmaIlanController@ilanAdd');
Route::post('firmaIlanOlustur/fiyatlandırmaBilgileri/{id}', 'FirmaIlanController@fiyatlandırmaBilgileriAdd');
Route::post('firmaIlanOlustur/firmateknik/{id}', 'FirmaIlanController@firmaTeknik');
Route::post('firmaIlanOlustur/kalemlerListesiMal/{id}', 'FirmaIlanController@kalemlerListesiMal');
Route::post('firmaIlanOlustur/kalemlerListesiHizmet/{id}', 'FirmaIlanController@kalemlerListesiHizmet');
Route::post('firmaIlanOlustur/kalemlerListesiGoturu/{id}', 'FirmaIlanController@kalemlerListesiGoturu');
Route::post('firmaIlanOlustur/kalemlerListesiYapim/{id}', 'FirmaIlanController@kalemlerListesiYapimİsi');
Route::post('firmaIlanOlustur/kalemlerListesiMalUpdate/{id}', 'FirmaIlanController@kalemlerListesiMalUpdate');
Route::post('firmaIlanOlustur/kalemlerListesiHizmetUpdate/{id}', 'FirmaIlanController@kalemlerListesiHizmetUpdate');
Route::post('firmaIlanOlustur/kalemlerListesiGoturuUpdate/{id}', 'FirmaIlanController@kalemlerListesiGoturuUpdate');
Route::post('firmaIlanOlustur/kalemlerListesiYapimİsiUpdate/{id}', 'FirmaIlanController@kalemlerListesiYapimİsiUpdate');
Route::delete('firmaIlanOlustur/mal/{id}', 'FirmaIlanController@deleteMal');
Route::delete('firmaIlanOlustur/hizmet/{id}', 'FirmaIlanController@deleteHizmet');
Route::delete('firmaIlanOlustur/goturu/{id}', 'FirmaIlanController@deleteGoturu');
Route::delete('firmaIlanOlustur/yapim/{id}', 'FirmaIlanController@deleteYapim');
Route::get('/firmaMal/{ilan_mal_id?}',function($ilan_mal_id){
        $mal=  App\IlanMal::find($ilan_mal_id);
        return Response::json($mal);
       
});
Route::get('/firmaHizmet/{ilan_hizmet_id?}',function($ilan_hizmet_id){
        $hizmet= App\IlanHizmet::find($ilan_hizmet_id);
        return Response::json($hizmet);
       
});
Route::get('/firmaGoturuBedel/{ilan_goturu_bedel_id?}',function($ilan_goturu_bedel_id){
        $goturu= App\IlanGoturuBedel::find($ilan_goturu_bedel_id);
        return Response::json($goturu);
       
});
Route::get('/firmaYapimİsi/{ilan_yapim_isi_id?}',function($ilan_yapim_isi_id){
        $yapim= App\IlanYapimIsi::find($ilan_yapim_isi_id);
        return Response::json($yapim);
       
});





Route::get('/ajax-subcat', function (Request $request) {
    
    $il_id = Input::get('il_id');
    
    //$il_id=1
    $ilceler = \App\Ilce::where('il_id', '=', $il_id)->get();
    return Response::json($ilceler);
});
Route::get('/ajax-subcatt', function () {
    $ilce_id = Input::get('ilce_id');
    $semtler = \App\Semt::where('ilce_id', '=', $ilce_id)->get();
    return Response::json($semtler);
});
 Route::auth();


