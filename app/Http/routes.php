<?php
use App\Form;
use App\iller;
use App\ilceler;
use App\semtler;
use App\adresler;
use App\adres_turleri;
use App\Sektor;
use App\Firma;
use App\iletisim_bilgileri;
use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    $firmalar = Firma::paginate(2);
    
    return view('Firma.firmalar')->with('firmalar', $firmalar);
});
Route::get('/image/{id}', function ($id) {
        $firmas=Firma::find($id);  
        return view('firmas.upload' )->with('firmas',$firmas);
    });
Route::post('firmaProfili/uploadImage/{id}', 'FirmaController@uploadImage');
Route::post('firmaProfili/deleteImage/{id}', 'FirmaController@deleteImage');

Route::post('firmaProfili/iletisimAdd/{id}', 'FirmaController@iletisimAdd');
Route::post('firmaProfili/tanitim/{id}', 'FirmaController@tanitimAdd');
Route::post('firmaProfili/malibilgi/{id}', 'FirmaController@maliBilgiAdd');
Route::post('firmaProfili/ticaribilgi/{id}', 'FirmaController@ticariBilgiAdd');

Route::post('/firma', 'FirmaController@firma');
Route::get('/firma/{id}', 'FirmaController@index');
Route::get('/firmaProfili/{id}', 'FirmaController@showFirma');

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

Route::get('/city', 'iller@index');
//Route::get('/ajax-subcat', 'ilcelerController@ajax');
//Route::get('/ajax-subcatt', 'semtler@ajaxdistrict');
//Route::get('/ajax-subcattt', 'semtler@ajaxneighborhood');
