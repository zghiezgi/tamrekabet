<?php

namespace App\Http\Controllers;
use App\Firma;
use App\Sektor;
use App\Il;
use App\IletisimBilgisi;
use App\Adres;
use App\SirketTuru;
use Session;
use File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class FirmaController extends Controller
{
    public function uploadImage(Request $request) {
        $file = $request->file('logo');
        
        // getting all of the post data
        $file = array('logo' => $request->file('logo'));
        // setting up rules
        $rules = array('logo' => 'required|mimes:jpeg,bmp,png|max:100000'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('firmaProfili/'.$request->firmaId)->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if ($request->file('logo')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = $request->file('logo')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

                $firma = Firma::find($request->id);
                $oldName=$firma->logo;
                $firma->logo = $fileName; 
                $firma->save();

                $request->file('logo')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                File::delete("uploads/$oldName");
                return Redirect::to('firmaProfili/'.$firma->id);
                //return  Redirect::route('commucations')->with('fileName', $fileName);
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('firmaProfili/'.$request->firmaId)->withInput()->withErrors($validator);
            }
        }
    }
    public function deleteImage($id)
    {
        $item = Firma::findOrFail($id);
        $oldName=$item->logo;
        $item->logo=null;
        $item->save();
        File::delete("uploads/$oldName");
        return Redirect::to('iletisimbilgilerii/'.$item->id);
    }
    public function iletisimAdd(Request $request){
        $validator = Validator::make($request->all(), [
                    'il_id' => 'required',
                    'ilce_id' => 'required',
                    'semt_id' => 'required',
                    'adres' => 'required',
                    'telefon' => 'required|numeric|size:10',
                    'fax' => 'required|numeric|size:10',
                    'web_sayfasi' => 'required|max:50',
        ]);

        /*if ($validator->fails()) {
            return redirect('firmaProfili/'.$request->id)
                            ->withInput()
                            ->withErrors($validator);
        }*/
        
        $firma = Firma::find($request->id);
        
        $iletisim = $firma->iletisim_bilgileri ?: new IletisimBilgisi();
        $iletisim->telefon = $request->telefon;
        $iletisim->fax = $request->fax;
        $iletisim->web_sayfasi = $request->web_sayfasi;
        $firma->iletisim_bilgileri()->save($iletisim);        

        $adres = $firma->adresler()->where('tur_id', '=', '1')->first() ?: new Adres();
        $adres->il_id = $request->il_id;
        $adres->ilce_id = $request->ilce_id;
        $adres->semt_id = $request->semt_id;
        $adres->adres = $request->adres;
        $tur = 1;
        $adres->tur_id = $tur;
        $firma->adresler()->save($adres);
        
        return redirect('firmaProfili/'.$firma->id);
    }
    public function tanitimAdd(Request $request){
        $validator = Validator::make($request->all(), [
                    'tanitim_yazisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('firmaProfili/'.$request->id)
                            ->withInput()
                            ->withErrors($validator);
        }
        
        $firma = Firma::find($request->id);
        
        $firma->tanitim_yazisi = $request->tanitim_yazisi;
        $firma->save();        
        return redirect('firmaProfili/'.$firma->id);
    }
    
    
    public function maliBilgiAdd(Request $request){
        $validator = Validator::make($request->all(), [
                    'unvani' => 'required',
                    'vergi_dairesi_id' => 'required',
                    'vergi_numarasi' => 'required',
                    'yillik_cirosu' => 'required',
                    'sermayesi' => 'required',
                    'ciro_goster' => 'required',
                    'sermaye_goster' => 'required',
                    'sirket_turu' => 'required',
                   
        ]);

        /*if ($validator->fails()) {
            return redirect('firmaProfili/'.$request->id)
                            ->withInput()
                            ->withErrors($validator);
        }*/
        
        $firma = Firma::find($request->id);
        $firma->sirket_turu = $request->sirket_turu;
        $firma->save();
        
        $maliBilgi = $firma->mali_bilgiler ?: new \App\MaliBilgi();
        $maliBilgi->unvani = $request->unvani;
        $maliBilgi->vergi_numarasi = $request->vergi_numarasi;
        $maliBilgi->vergi_dairesi_id = $request->vergi_dairesi_id;
        $maliBilgi->sermayesi = $request ->sermayesi;
        $maliBilgi->yillik_cirosu = $request ->yillik_cirosu;
        $maliBilgi->ciro_goster = $request ->ciro_goster;
        $maliBilgi->sermaye_goster = $request ->sermaye_goster;
        $firma->mali_bilgiler()->save($maliBilgi);        
        
        
        $adres = $firma->adresler()->where('tur_id', '=', '2')->first() ?: new Adres();
        $adres->il_id = $request->mali_il_id;
        $adres->ilce_id = $request->mali_ilce_id;
        $adres->semt_id = $request->mali_semt_id;
        $adres->adres = $request->fatura_adres;
        $tur = 2;
        $adres->tur_id = $tur;
        $firma->adresler()->save($adres);
        
        return redirect('firmaProfili/'.$firma->id);
    }
    public function ticariBilgiAdd(Request $request){
        $validator = Validator::make($request->all(), [
                    'ticaret_sicil_no' => 'required',
                    'ticaret_odasi' => 'required',
                    'ust_sektor' => 'required',
                    'faaliyet_sektorleri' => 'required',
                    'firma_departmanları' => 'required',
                    'kurulus_tarihi' => 'required',
                    'firma_faaliyet_turu' => 'required',
                    'firmanin_urettigi_markalar' => 'required',
                    'firmanin_sattıgı_markalar' => 'required',
                   
        ]);

        /*if ($validator->fails()) {
            return redirect('firmaProfili/'.$request->id)
                            ->withInput()
                            ->withErrors($validator);
        }*/
        
        $firma = Firma::find($request->id);
        $firma->kurulus_tarihi=$request->kurulus_tarihi;
        $firma->save();
        
        $ticariBilgi = $firma->ticari_bilgiler ?: new \App\TicariBilgi();
        $ticariBilgi->tic_sicil_no = $request->ticaret_sicil_no;
        $ticariBilgi->tic_oda_id = 1;//$request->ticaret_odasi;
        $ticariBilgi->ust_sektor_id = $request->ust_sektor;
        
        $firma->ticari_bilgiler()->save($ticariBilgi);        
        
        $uretilenMarka = $firma->uretilen_markalar ?: new \App\UretilenMarka();
        foreach($request->firmanın_urettigi_markalar as $urettigiMarka)
        $uretilenMarka->adi = $urettigiMarka;
        
        $firma->uretilen_markalar()->save($uretilenMarka);
        
        foreach($request->faaliyet_sektorleri as $sektor)
        $firma->sektorler()->attach($sektor);
        
        foreach($request->firma_departmanları as $departman)
        $firma->departmanlar()->attach($departman);
        
        foreach($request->firmanin_sattıgı_markalar as $markalar)
        $firma->satilan_markalar()->attach($markalar);
        
        foreach($request->firma_faaliyet_turu as $faaliyetTur)
        $firma->faaliyetler()->attach($faaliyetTur);
        
        return redirect('firmaProfili/'.$firma->id);
    }
    
    
    //eski fonksiyonlar
    public function firma(Request $request){
        $validator = Validator::make($request->all(), [
                    'firmaAdi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                            ->withInput()
                            ->withErrors($validator);
        }
        //console.log($request);

        $firma = new Firma();
        $firma->adi = $request->firmaAdi;
        $firma->save();
        
        foreach($request->sektor as $sektor)
            $firma->sektorler()->attach($sektor);


        return redirect('/');
    } 
    public function index($id){
        $firmalar = Firma::find($id);
        $sektorler = Sektor::all();

        return view('firmaKaydet')->with('firmalar',$firmalar)->with('sektorler', $sektorler);
    }
    public function showFirma($id){
        $firma = Firma::find($id);
        $iller = Il::all();
        $sirketTurleri=  SirketTuru::all();
        $vergiDaireleri= \App\VergiDairesi::all();
        $ticaretodasi=  \App\TicaretOdasi::all();
        $ustsektor=  Sektor::all();
        $departmanlar=  \App\Departman::all();
        $markalar=  \App\SatilanMarka::all();
        $faaliyetler= \App\Faaliyet::all();
        return view('Firma.firmaProfili', ['firma' => $firma], ['iller' => $iller])->with('sirketTurleri',$sirketTurleri)->with('vergiDaireleri',$vergiDaireleri)->with('ustsektor',$ustsektor)->with('ticaretodasi',$ticaretodasi)->with('departmanlar',$departmanlar)->with('markalar',$markalar)->with('faaliyetler',$faaliyetler);
    }
}
