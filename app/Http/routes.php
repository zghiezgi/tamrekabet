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
    $firmalar = Firma::all();
    
    return view('Firma.firmalar')->with('firmalar', $firmalar);
});

Route::post('/form', function (Request $request) {
    $validator = Validator::make($request->all(), [
                'city_id' => 'required',
                'district_id' => 'required',
                'neighborhood_id' => 'required',
                'posta_kodu' => 'required',
                'telefon' => 'required',
                'fax' => 'required',
                'web_sayfasi' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/')
                        ->withInput()
                        ->withErrors($validator);
    }

    $iletisim = new iletisim_bilgileri();
    $iletisim->telefon = $request->telefon;
    $iletisim->fax = $request->fax;
    $iletisim->web_sayfasi = $request->web_sayfasi;
    //$iletisim->save();
    
    $adres = new adresler();
    $adres->il_id = $request->city_id;
    $adres->ilce_id = $request->district_id;
    $adres->semt_id = $request->neighborhood_id;
    $adres->posta_kodu = $request->posta_kodu;
    //$tur = adres_turleri::where('adi', '=', 'İletişim')->select('id')->get();
    $adres->tur_id = 1;
    $adres->save();
    
    $iletisim->adres_id = $adres->id;
    
    $iletisim->save();


    return redirect('/');
});

Route::post('/firma', 'FirmaController@firma');
Route::get('/firma/{id}', 'FirmaController@index');

Route::get('/ajax-subcat', function () {
    $city_id = Input::get('city_id');

		$districts = \App\ilceler::where('il_id', '=', $city_id)->get();

		return Response::json($districts);
});
Route::get('/ajax-subcatt', function () {
    $district_id = Input::get('district_id');

		$neighborhoods = \App\semtler::where('ilce_id', '=', $district_id)->get();

		return Response::json($neighborhoods);
});
Route::get('/ajax-subcattt', function () {
    $neighborhood_id=Input::get('neighborhood_id');

		$neighborhoods = \App\semtler::where('id', '=', $neighborhood_id)->get();

		return Response::json($neighborhoods);
});

Route::get('/city', 'iller@index');
//Route::get('/ajax-subcat', 'ilcelerController@ajax');
//Route::get('/ajax-subcatt', 'semtler@ajaxdistrict');
//Route::get('/ajax-subcattt', 'semtler@ajaxneighborhood');
