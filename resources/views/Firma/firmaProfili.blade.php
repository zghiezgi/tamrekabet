<?php
    use App\Adres;
    use App\Il;
    use App\Ilce;
    use App\IletisimBilgisi;
    use App\Semt;
?>
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
           <script src="{{asset('js/ajax-crud.js')}}"></script>
                        <style>
                            table {
                                font-family: arial, sans-serif;
                                border-collapse: collapse;
                                width: 100%;
                            }

                            td, th {

                                text-align: left;
                                padding: 5px;
                            }
                            .button {
                                background-color: #555555; /* Green */
                                border: none;
                                color: white;
                                padding: 10px 22px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 13px;
                                margin: 4px 2px;
                                cursor: pointer;
                                float:right;
                            }
                            .button1 {
                                background-color: #555555; /* Green */
                                border: none;
                                color: white;
                                padding: 10px 22px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 13px;
                                margin: 4px 2px;
                                cursor: pointer;
                                float:left;
                            }



                        </style>
                        </head>
                        <body>
                        <div class="container">
                            <h2>Firma Profili</h2>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4" ><img src="/tamrekabet/public/uploads/{{$firma->logo}}" alt="HTML5 Icon" style="width:128px;height:128px;"></div>
                                        <div class="col-sm-4" ><h3>{{$firma->adi}}</h3></div>
                                    </div>
                                    <div class="modal fade" id="myModal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Resmini Güncelle</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="span7 offset1">
                                                        @if(Session::has('success'))
                                                        <div class="alert-box success">
                                                            <h2>{!! Session::get('success') !!}</h2>
                                                        </div>
                                                        @endif
                                                        <div class="secure">Yeni Bir Resim Yükleyin</div>
                                                        {!! Form::open(array('url'=>'firmaProfili/uploadImage/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                {!! Form::file('logo') !!}
                                                                <p class="errors">{!!$errors->first('image')!!}</p>
                                                                @if(Session::has('error'))
                                                                <p class="errors">{!! Session::get('error') !!}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div id="success">

                                                        </div>

                                                        {!! Form::submit('Yükle', array('url'=>'firmaProfili/uploadImage'.$firma->id,'class'=>'btn btn-danger')) !!}


                                                        {!! Form::close() !!}
                                                        <br>
                                                        {{ Form::open(array('url'=>'firmaProfili/deleteImage/'.$firma->id,'method' => 'DELETE', 'files'=>true)) }}
                                                        {{ Form::hidden('id', $firma->logo) }}
                                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                                        {{ Form::close() }}
                                                    </div>




                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary btn-xs btn-detail open-modal-image" onclick="" value="{{$firma->id}}">Düzenle</button>

                                    <script src="{{asset('js/ajax-crud-image.js')}}"></script>
                                </div>


                            </div>



                        </div>
                        <div class="container">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class=" medium material-icons">call</i>İletişim Bilgileri</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">

                                                    <tr>
                                                        <td>Adres:</td>
                                                        <?php $firmaAdres = $firma->adresler()->where('tur_id', '=', '1')->first();
                                                              if(!$firma->iletisim_bilgileri)
                                                                  $firma->iletisim_bilgileri = new IletisimBilgisi();
                                                              if(!$firmaAdres){
                                                                  $firmaAdres = new Adres();
                                                                  $firmaAdres->iller = new Il();
                                                                  $firmaAdres->ilceler = new Ilce();
                                                                  $firmaAdres->semtler = new Semt();
                                                              }
                                                        ?>
                                                        <td>{{$firmaAdres->adres}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>İli:</td>
                                                        <td>{{$firmaAdres->iller->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>İlçesi:</td>
                                                        <td>{{$firmaAdres->ilceler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Semt:</td>
                                                        <td>{{$firmaAdres->semtler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Telefon:</td>
                                                        <td>{{$firma->iletisim_bilgileri->telefon}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Fax</td>
                                                        <td>{{$firma->iletisim_bilgileri->fax}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Web Sayfası:</td>
                                                        <td>{{$firma->iletisim_bilgileri->web_sayfasi}}</td>

                                                    </tr>
                                                    </tr>
                                                </thead>

                                            </table>
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">İletişim Bilgileri</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'firmaProfili/iletisimAdd/'.$firma->id, 'class' => 'form-horizontal', 'method' => 'POST')) !!}

                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">Şehir</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="il_id" id="il_id" required>
                                                                            <option selected disabled>Seçiniz</option>
                                                                            @foreach($iller as $il)
                                                                            <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="ilce_id" id="ilce_id" required>
                                                                            <option selected disabled>Seçiniz</option>

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">Semt</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="semt_id" id="semt_id" required>
                                                                            <option selected disabled>Seçiniz</option>

                                                                        </select>
                                                                    </div>

                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Adres</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" required value="{{$firmaAdres->adres}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Telefon</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" value="{{$firma->iletisim_bilgileri->telefon}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Fax</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="{{$firma->iletisim_bilgileri->fax}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Web Sayfası</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="web_sayfasi" name="web_sayfasi" placeholder="Web Sayfası" value="{{$firma->iletisim_bilgileri->web_sayfasi}}">
                                                                    </div>
                                                                </div>
                                                                {!! Form::submit('Kaydet', array('url'=>'firmaProfili/iletisimAdd/'.$firma->id,'class'=>'btn btn-danger')) !!}

                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">

                                                            <input type="hidden" id="iletisimbilgisi_id" name="iletisimbilgisi_id" value="{{$firma->iletisim_bilgileri->id}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs" onclick="selectDD()" >Ekle / Düzenle</button>


                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Firma Tanıtım Yazısı</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">
                                                    <tr id="firma{{$firma->id}}">
                                                        <tr>
                                                            <td>Tanıtım Yazısı:</td>
                                                            <td>{{$firma->tanitim_yazisi}}</td>
                                                        </tr>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <div class="modal fade" id="myModal-tanıtımyazısı" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Firma Tanıtım Yazısı</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(array('url'=>'firmaProfili/tanitim/'.$firma->id,'method'=>'POST', 'files'=>true)) !!}

                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Tanıtım Yazısı</label>
                                                                    <div class="col-sm-9">
                                                                        <!--input type="text" class="form-control" id="tanıtım_yazısı" name="tanıtım_yazısı" placeholder="Tanıtım Yazısı" value=""-->
                                                                        <textarea id="tanitim_yazisi" name="tanitim_yazisi" rows="7" class="form-control ckeditor" placeholder="Lütfen tanıtım yazısını buraya yazınız.." ></textarea>
                                                                    </div>
                                                                </div>

                                                            {!! Form::submit('Kaydet', array('url'=>'firmaProfili/tanitim/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="btn-add-tanıtımyazısı" name="btn-add-tanıtımyazısı" class="btn btn-primary btn-xs" onclick="fillTanitim()">Ekle / Düzenle</button>
                                            <script src="{{asset('js/ajax-crud-firmaTanitim.js')}}"></script>
                                            <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Mali Bilgileri</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                         <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">

                                                    <tr>
                                                        <td>Firma Ünvanı:</td>
                                                        <?php $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
                                                              if(!$firma->mali_bilgiler){
                                                                  $firma->mali_bilgiler = new App\MaliBilgi();
                                                                  $firma->mali_bilgiler->vergi_daireleri = new App\VergiDairesi();
                                                                  $firma->sirket_turleri = new App\SirketTuru();

                                                              }
                                                              if(!$firmaFatura){
                                                                  $firmaFatura = new Adres();
                                                                  $firmaFatura->iller = new Il();
                                                                  $firmaFatura->ilceler = new Ilce();
                                                                  $firmaFatura->semtler = new Semt();
                                                              }
                                                        ?>
                                                     <td>{{$firma->mali_bilgiler->unvani}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Şirket Türü:</td>
                                                        @foreach($firma->sirket_turleri() as $turleri)

                                                        <td>{{$turleri->adi}}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td>Fatura Adresi:</td>
                                                        <td>{{$firmaFatura->adres}}</td>

                                                    </tr>
                                                     <tr>
                                                        <td>İli:</td>
                                                        <td>{{$firmaFatura->iller->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>İlçesi:</td>
                                                        <td>{{$firmaFatura->ilceler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Semt:</td>
                                                        <td>{{$firmaFatura->semtler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Vergi Dairesi:</td>
                                                        <td>{{$firma->mali_bilgiler->vergi_daireleri->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Vergi Numarası:</td>
                                                        <td>{{$firma->mali_bilgiler->vergi_numarasi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Yıllık Cirosu:</td>
                                                        <td>{{$firma->mali_bilgiler->yillik_cirosu}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Sermayesi:</td>
                                                        <td>{{$firma->mali_bilgiler->sermayesi}}</</td>

                                                    </tr>

                                                </thead>


                                            </table>
                                            <div class="modal fade" id="myModal-malibilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Mali Bilgiler</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                             {!! Form::open(array('url'=>'firmaProfili/malibilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Firma Ünvanı</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="unvani" name="unvani" placeholder="Firma Ünvanı" value="{{$firma->mali_bilgiler->unvani}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Şirket Türü</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="sirket_turu" id="sirket_turu" required>
                                                                            <option selected disabled>Seçiniz</option>
                                                                            @foreach($sirketTurleri as $tur)
                                                                                <option  value="{{$tur->id}}" >{{$tur->adi}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Fatura Adresi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="fatura_adresi" name="fatura_adresi" placeholder="Fatura Adresi" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">Şehir</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="mali_il_id" id="mali_il_id" required>
                                                                            <option selected disabled>Seçiniz</option>
                                                                            @foreach($iller as $il)
                                                                                <option  value="{{$il->id}}" >{{$il->adi}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">İlçe</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="mali_ilce_id" id="mali_ilce_id" required>
                                                                            <option selected disabled>Seçiniz</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group error">
                                                                    <label for="inputTask" class="col-sm-3 control-label">Semt</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="mali_semt_id" id="mali_semt_id" required>
                                                                            <option selected disabled>Seçiniz</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Vergi Daireleri</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" name="vergi_dairesi_id" id="vergi_dairesi_id" required>
                                                                                <option selected disabled>Seçiniz</option>
                                                                                @foreach($vergiDaireleri as $vergiDaire)
                                                                                    <option  value="{{$vergiDaire->id}}" >{{$vergiDaire->adi}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Vergi Numarası</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="vergi_numarasi" name="vergi_numarasi" placeholder="Vergi Numarası" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Yıllık Cirosu</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="yillik_cirosu" name="yillik_cirosu" placeholder="Yıllık Cirosu" value="">
                                                                            <input type="checkbox" class="form-control" id="ciro_goster" name="ciro_goster" >Göster<br></input>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Sermayesi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="sermayesi" name="sermayesi" placeholder="Sermayesi" value="">
                                                                            <input type="checkbox" class="form-control" id="sermaye_goster" name="sermaye_goster" >Göster<br></input>
                                                                    </div>
                                                                </div>
                                                            {!! Form::submit('Kaydet', array('url'=>'firmaProfili/malibilgi/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="btn-add-malibilgiler" name="btn-add-malibilgiler" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                                            <script src="{{asset('js/ajax-crud-malibilgiler.js')}}"></script>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ticari Bilgiler</a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                         <table class="table" >
                                                <thead id="tasks-list" name="tasks-list">

                                                    <tr>
                                                        <td>Ticaret Sicil No:</td>
                                                        <?php $firmaFatura = $firma->adresler()->where('tur_id', '=', '2')->first();
                                                              if(!$firma->ticari_bilgiler){
                                                                  $firma->ticari_bilgiler = new App\TicariBilgi();
                                                                  $firma->ticari_bilgiler->ticaret_odalari = new App\TicaretOdasi();
                                                                  $firma->ticari_bilgiler->sektorler = new App\Sektor();

                                                                  $firma->firma_departmanlar = new App\FirmaDepartman();
                                                                  $firma->firma_departmanlar->departmanlar = new App\Departman();

                                                                  $firma->firma_sektorler = new App\FirmaSektor();
                                                                  $firma->firma_sektorler->sektorler= new App\Sektor();

                                                                  $firma->firma_satilan_markalar= new App\FirmaSatilanMarka();
                                                                  $firma->firma_satilan_markalar->satilan_markalar= new App\SatilanMarka();

                                                                  $firma->firma_faaliyetler= new App\FirmaFaaliyet();
                                                                  $firma->firma_faaliyetler->faaliyetler= new App\Faaliyet();



                                                              }
                                                              if(!$firma->uretilen_markalar){
                                                                    $firma->uretilen_markalar= new App\UretilenMarka();
								}

                                                        ?>
                                                        <td>{{$firma->ticari_bilgiler->tic_sicil_no}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Ticaret Odası:</td>
                                                        <td>{{$firma->ticari_bilgiler->ticaret_odalari->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Üst Sektör:</td>
                                                        <td>{{$firma->ticari_bilgiler->sektorler->adi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Faliyet Sektör:</td>
                                                         <td>@foreach($firma->sektorler as $sektor)
                                                            {{$sektor->adi}}
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>Firma Departmanları:</td>
                                                        <td>@foreach($firma->departmanlar as $departman)
                                                            {{$departman->adi}}
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>Kuruluş Tarihi:</td>
                                                        <td>{{$firma->kurulus_tarihi}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td>Firma Faaliyet Türü:</td>

                                                        <td>@foreach($firma->faaliyetler as $faaliyet)
                                                            {{$faaliyet->adi}}
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>Firmanın Ürettiği Markalar:</td>
                                                        <td>
                                                            @foreach($firma->uretilen_markalar as $marka)
                                                            {{$marka->adi}}
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                     <tr>
                                                        <td>Firmanın Sattığı Markalar:</td>
                                                       <td>@foreach($firma->satilan_markalar as $satMarka)
                                                            {{$satMarka->adi}}
                                                            @endforeach
                                                        </td>

                                                    </tr>

                                                </thead>


                                            </table>
                                            <div class="modal fade" id="myModal-ticaribilgiler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Ticari Bilgiler</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                             {!! Form::open(array('url'=>'firmaProfili/ticaribilgi/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                                                 <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Ticaret Sicil NO</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="ticaret_sicil_no" name="ticaret_sicil_no" placeholder="Ticaret Sicil No" value="{{$firma->ticari_bilgiler->tic_sicil_no}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Ticaret Odası</label>
                                                                    <div class="col-sm-9">
                                                                         <select class="form-control" name="ticaret_odasi" id="ticaret_odasi" required>
                                                                                <option selected disabled>Seçiniz</option>
                                                                                @foreach($ticaretodasi as $ticaret)
                                                                                    <option  value="{{$ticaret->id}}" >{{$ticaret->adi}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Üst Sektör</label>
                                                                    <div class="col-sm-9">
                                                                       <select class="form-control" name="ust_sektor" id="ust_sektor" required>
                                                                                <option selected disabled>Seçiniz</option>
                                                                                @foreach($ustsektor as $ust)
                                                                                    <option  value="{{$ust->id}}" >{{$ust->adi}}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Faaliyet Sektörleri</label>
                                                                    <div class="col-sm-9">
                                                                        @foreach($ustsektor as $sektor)
                                                                                <input type="checkbox" name="faaliyet_sektorleri[]" value="{{$sektor->id}}">{{$sektor->adi}}
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Firma Departmanları</label>
                                                                    <div class="col-sm-9">
                                                                        @foreach($departmanlar as $departman)
                                                                                <input type="checkbox" name="firma_departmanları[]" value="{{$departman->id}}">{{$departman->adi}}
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Kuruluş Tarihi</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" class="form-control datepicker" id="kurulus_tarihi" name="kurulus_tarihi" placeholder="Kuruluş Tarihi" value="{{$firma->kurulus_tarihi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Firma Faaliyet Türü</label>
                                                                    <div class="col-sm-9">
                                                                          @foreach($faaliyetler as $faaliyet)
                                                                                <input type="checkbox" name="firma_faaliyet_turu[]" value="{{$faaliyet->id}}">{{$faaliyet->adi}}
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="inputEmail3" class="col-sm-3 control-label">Üretilen Markalar</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input_fields_wrap">
                                                                            <button class="add_field_button"><i class="large material-icons">queue</i></button>
                                                                            <div><input type="text" class="form-control"  name="mytext[]"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label">Firmanın Sattığı Markalari</label>
                                                                    <div class="col-sm-9">

                                                                                @foreach($markalar as $marka)
                                                                                   <input type="checkbox" name="firmanin_sattıgı_markalar[]" value="{{$marka->id}}">{{$marka->adi}}
                                                                                @endforeach

                                                                    </div>
                                                                </div>

                                                            {!! Form::submit('Kaydet', array('url'=>'firmaProfili/ticaribilgi/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="btn-add-ticaribilgiler" name="btn-add-ticaribilgiler" class="btn btn-primary btn-xs">Ekle / Düzenle</button>
                                            <script src="{{asset('js/ajax-crud-ticaribilgiler.js')}}"></script>
                                            <!-- Include Date Range Picker -->
                                            <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
                                            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<script>

var selectDD = function() {
    GetIlce({{$firmaAdres->iller->id}});
    GetSemt({{$firmaAdres->ilceler->id}});
    $("#il_id").val({{$firmaAdres->iller->id}});
    $("#ilce_id").val({{$firmaAdres->ilceler->id}});
    $("#semt_id").val({{$firmaAdres->semtler->id}});
    
        /*alert("doluyum ben");
        popDropDown('ilce_id', 'ajax-subcat?il_id=', {{$firmaAdres->iller->id}});
        popDropDown('semt_id', 'ajax-subcatt?ilce_id=', {{$firmaAdres->ilceler->id}});
        $("#il_id").val({{$firmaAdres->iller->id}});
        $("#ilce_id").val({{$firmaAdres->ilceler->id}});
        alert("seçtim");
        
    */
}

var fillTanitim = function () {
    CKEDITOR.instances['tanitim_yazisi'].setData('{{$firma->tanitim_yazisi}}');
}

function GetIlce(il_id) {
    if (il_id > 0) {
        $("#ilce_id").get(0).options.length = 0;
        $("#ilce_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 
 
        $.ajax({
            type: "GET",
            url: "/tamrekabet/public/index.php/ajax-subcat?il_id="+il_id,
            
            contentType: "application/json; charset=utf-8",
      
            success: function(msg) {
                $("#ilce_id").get(0).options.length = 0;
                $("#ilce_id").get(0).options[0] = new Option("Seçiniz", "-1");
 
                $.each(msg, function(index, ilce) {
                    $("#ilce_id").get(0).options[$("#ilce_id").get(0).options.length] = new Option(ilce.adi, ilce.id);
                });
            },
            async: false,
            error: function() {
                $("#ilce_id").get(0).options.length = 0;
                alert("İlçeler yükelenemedi!!!");
            }
        });
    }
    else {
        $("#ilce_id").get(0).options.length = 0;
    }
} 

function GetSemt(ilce_id) {
    if (ilce_id > 0) {
        $("#semt_id").get(0).options.length = 0;
        $("#semt_id").get(0).options[0] = new Option("Yükleniyor", "-1"); 
 
        $.ajax({
            type: "GET",
            url: "/tamrekabet/public/index.php/ajax-subcatt?ilce_id="+ilce_id,
            
            contentType: "application/json; charset=utf-8",
      
            success: function(msg) {
                $("#semt_id").get(0).options.length = 0;
                $("#semt_id").get(0).options[0] = new Option("Seçiniz", "-1");
 
                $.each(msg, function(index, semt) {
                    $("#semt_id").get(0).options[$("#semt_id").get(0).options.length] = new Option(semt.adi, semt.id);
                });
            },
            async: false,
            error: function() {
                $("#semt_id").get(0).options.length = 0;
                alert("Semtler yükelenemedi!!!");
            }
        });
    }
    else {
        $("#semt_id").get(0).options.length = 0;
    }
} 


var popDropDown = function (element, ajax, parameter){
    
        //alert(element+","+ajax+","+parameters);
    $.get('/tamrekabet/public/index.php/'+ ajax + parameter, function (data) {
        $('#'+ element).empty();
        $('#'+ element).append('<option value=""> Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#'+ element).append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    });
    alert(element);
}

$('#il_id').on('change', function (e) {
    alert("change");
    var il_id = e.target.value;
    GetIlce(il_id);
    //popDropDown('ilce_id', 'ajax-subcat?il_id=', il_id);
    //$("#semt_id")[0].selectedIndex=0;
});

$('#ilce_id').on('change', function (e) {
    var ilce_id = e.target.value;
    GetSemt(ilce_id);
    //popDropDown('semt_id', 'ajax-subcatt?ilce_id=', ilce_id);
});

$('#mali_il_id').on('change', function (e) {
    var il_id = e.target.value;
    popDropDown('mali_ilce_id', 'ajax-subcat?il_id=', il_id);
    $("#mali_semt_id")[0].selectedIndex=0;
});

$('#mali_ilce_id').on('change', function (e) {
    var ilce_id = e.target.value;
    popDropDown('mali_semt_id', 'ajax-subcatt?ilce_id=', ilce_id);
});


</script>
                        </body>
                        </html>
                        @endsection
