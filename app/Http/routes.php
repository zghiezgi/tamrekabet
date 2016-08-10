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



