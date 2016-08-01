<?php

namespace App\Http\Controllers;
use App\Firma;
use App\Sektor;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class FirmaController extends Controller
{
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

        return view('firmaProfili')->with('firmalar','$firmalar')->with('sektorler', $sektorler);
    }
}
