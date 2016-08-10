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
use Illuminate\Http\Request;


Route::get('/', function () {
    $firmalar = Firma::paginate(2);
    return view('Firma.firmalar')->with('firmalar', $firmalar);
});
Route::get('/image/{id}', function ($id) {
    $firmas = Firma::find($id);
    return view('firmas.upload')->with('firmas', $firmas);
});
Route::post('firmaProfili/uploadImage/{id}', 'FirmaController@uploadImage');
Route::post('firmaProfili/deleteImage/{id}', 'FirmaController@deleteImage');
Route::post('firmaProfili/iletisimAdd/{id}', 'FirmaController@iletisimAdd');
Route::post('firmaProfili/tanitim/{id}', 'FirmaController@tanitimAdd');
Route::post('firmaProfili/malibilgi/{id}', 'FirmaController@maliBilgiAdd');
Route::post('firmaProfili/ticaribilgi/{id}', 'FirmaController@ticariBilgiAdd');
Route::post('firmaProfili/kalite/{id}', 'FirmaController@kaliteAdd');
Route::post('firmaProfili/referans/{id}', 'FirmaController@referansAdd');
Route::post('firmaProfili/firmaCalisan/{id}', 'FirmaController@calisanGunleriAdd');
Route::post('firmaProfili/bilgilendirmeTercihi/{id}', 'FirmaController@bilgilendirmeTercihiAdd');
Route::post('firmaProfili/firmaBrosur/{id}', 'FirmaController@uploadPdf');
Route::post('firmaProfili/referansUpdate/{id}', 'FirmaController@referansUpdate');
Route::get('/firmaProfili/{id}', 'FirmaController@showFirma');
Route::get('/firma/{id}',function($id){
    $referans= \App\FirmaReferans::find($id);
    return Response::json($referans);
  
});
Route::get('/ajax-subcat', function () {
    $city_id = Input::get('il_id');
    $districts = \App\Ilce::where('il_id', '=', $city_id)->get();
    return Response::json($districts);
});
Route::get('/ajax-subcatt', function () {
    $district_id = Input::get('ilce_id');
    $neighborhoods = \App\Semt::where('ilce_id', '=', $district_id)->get();
    return Response::json($neighborhoods);
});
Route::get('/ajax-subcattt', function () {
    $neighborhood_id=Input::get('semt_id');
    $neighborhoods = \App\Semt::where('id', '=', $neighborhood_id)->get();
    return Response::json($neighborhoods);
});


