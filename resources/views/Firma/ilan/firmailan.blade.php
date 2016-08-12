<?php
    use App\Adres;
    use App\Il;
    use App\Ilce;
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
        <script src="{{asset('js/ilan/ajax-crud-firmabilgilerim.js')}}"></script>
        <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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
       <h2>İlan Oluştur</h2>
   </div>
  <div class="container">
       <div class="panel-group" id="accordion">
          <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Firma Bilgilerim</a>
                   </h4>
               </div>
               <div id="collapse1" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>Firma Adı:</td>
                                   <?php
                                   $firmaBilgilerim = $firma->where('goster', '=', 'Göster');
                                   $firma->firma_sektorler = new App\FirmaSektor();
                                   $firma->firma_sektorler->sektorler = new App\Sektor();
                                   ?>
                                   <td>{{$firma->adi}}</td>
                               </tr>
                               <tr>
                                   <td>Firma Sektör:</td>
                                   <td> @foreach($firma->sektorler as $sektor)
                                       {{$sektor->adi}}
                                       @endforeach
                                  </td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-firmaBilgilerim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Firma Bilgilerim</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaIlanOlustur/firmaBilgilerim/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control " id="firma_adi" name="firma_adi" placeholder="Firma Adı" value="{{$firma->adi}}"/>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Firma Adı Göster</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="firma_adi_gizli" id="firma_adi_gizli" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Göster">Göster</option>
                                                    <option  value="Gizle">Gizle</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Firma Sektör</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="firma_sektor" id="firma_sektor" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($sektorler as $sektor)
                                                   <option  value="{{$sektor->id}}" >{{$sektor->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/firmaBilgilerim/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-firmaBilgilerim" name="btn-add-firmaBilgilerim" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">İlan Bilgilerim</a>
                   </h4>
               </div>
               <div id="collapse2" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>İlan Adı:</td>
                                   
                                   <?php 
                                   $firmaAdres = $firma->adresler()->first();
                                   if (!$firmaAdres) {
                                       $firmaAdres = new Adres();
                                       $firmaAdres->iller = new Il();
                                       $firmaAdres->ilceler = new Ilce();
                                       $firmaAdres->semtler = new Semt();
                                   }
                                   ?>
                                   <td></td>
                               </tr>
                                <tr>
                                   <td>İlan Yayınlama Tarihi:</td>
                                   <td></td>
                               </tr>
                                <tr>
                                   <td>İlan Kapanma Tarihi:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>İlan Açıklaması:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>ilan Türü:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>İlan Usulü:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Sözleşme Türü:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Teknik Şartname:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Yaklaşık Maliyet:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Teslim Yeri:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>İşin Süresi:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>İş Başlama Tarihi:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>İş Bitiş Tarihi:</td>
                                   <td></td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-ilanBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">İlan Bilgileri</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaIlanOlustur/ilanBilgileri/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}
                                       
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">İlan Adı</label>
                                           <div class="col-sm-9">
                                               <input type="text" class="form-control" id="ilan_adi" name="ilan_adi" placeholder="İlan Adı" value="">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Yayınlama Tarihi</label>
                                           <div class="col-sm-9">
                                               <input type="date" class="form-control datepicker" id="yayinlama_tarihi" name="yayinlama_tarihi" placeholder="Yayınlama Tarihi" value="">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Kapanma Tarihi</label>
                                           <div class="col-sm-9">
                                               <input type="date" class="form-control datepicker" id="kapanma_tarihi" name="kapanma_tarihi" placeholder="Kapanma Tarihi" value="">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Açıklama</label>
                                           <div class="col-sm-9">
                                               <!--input type="text" class="form-control " id="aciklama" name="aciklama" placeholder="Açıklama" value=""-->
                                               <textarea id="aciklama" name="aciklama" rows="5" class="form-control ckeditor" placeholder="Lütfen Açıklamayı buraya yazınız.." ></textarea>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">İlan Türü</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="ilan_turu" id="ilan_turu" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Mal">Mal</option>
                                                    <option  value="Hizmet">Hizmet</option>
                                                    <option  value="Yapım İşi">Yapım İşi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">İlan Usulü</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="ilan_usulu" id="ilan_usulu" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Açık">Açık</option>
                                                    <option  value="Belirli İstekler Arasında">Belirli İstekler Arasında</option>
                                                    <option  value="Başvuru">Başvuru</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Sözleşme Türü</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="sozlesme_turu" id="sozlesme_turu" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Birim Fiyatlı">Birim Fiyatlı</option>
                                                    <option  value="Götürü Bedel">Götürü Bedel</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Teknik Şartname</label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" class="filled-in" id="filled-in-box" name="teknik_sartname" checked="checked" />  
                                            </div>
                                        </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Yaklaşık Maliyet</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="yaklasik_maliyet" id="yaklasik_maliyet" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($maliyetler as $maliyet)
                                                   <option  value="{{$maliyet->id}}" >{{$maliyet->alt_deger}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Teslim Yeri</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="teslim_yeri" id="teslim_yeri" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Satıcı Firma">Satıcı Firma</option>
                                                    <option  value="Adrese Teslim">Adrese Teslim</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group error">
                                           <label for="inputTask" class="col-sm-3 control-label">Teslim Yeri İl</label>
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
                                           <label for="inputTask" class="col-sm-3 control-label">Teslim Yeri İlçe</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="ilce_id" id="ilce_id" required>
                                                   <option selected disabled>Seçiniz</option>

                                               </select>
                                           </div>
                                       </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">İşin Süresi</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="isin_suresi" id="isin_suresi" required>
                                                    <option selected disabled value="Seçiniz">Seçiniz</option>
                                                    <option   value="Tek Seferde">Tek Seferde</option>
                                                    <option  value="Zamana Yayılarak">Zamana Yayılarak</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">İş Başlama Tarihi</label>
                                           <div class="col-sm-9">
                                               <input type="date" class="form-control datepicker" id="is_baslama_tarihi" name="is_baslama_tarihi" placeholder="İş Başlama Tarihi" value="">
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">İş Bitiş Tarihi</label>
                                           <div class="col-sm-9">
                                               <input type="date" class="form-control datepicker" id="is_bitis_tarihi" name="is_bitis_tarihi" placeholder="İş Bitiş Tarihi" value="">
                                           </div>
                                       </div>
                                       
                                        

                                       {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/ilanBilgileri/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-ilanBilgileri" name="btn-add-ilanBilgileri" class="btn btn-primary btn-xs" onclick="">Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Fiyatlandırma Bigileri</a>
                   </h4>
               </div>
               <div id="collapse3" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td>KDV:</td> 
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Ödeme Türü:</td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td>Para Birimi:</td>
                                   <td></td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-fiyatlandırmaBilgileri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Fiyatlandırma Bilgileri</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileri/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                       <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">KDV</label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" class="filled-in" id="filled-in-box" name="kdv" checked="checked" />  
                                            </div>
                                        </div>
                                     <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="odeme_turu" id="odeme_turu" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($odeme_turleri as $odeme_turu)
                                                   <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="para_birimi" id="para_birimi" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($para_birimleri as $para_birimi)
                                                   <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/fiyatlandırmaBilgileri/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-fiyatlandırmaBilgileri" name="btn-add-fiyatlandırmaBilgileri" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>
                <div class="panel panel-default">
               <div class="panel-heading">
                   <h4 class="panel-title">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Fiyat İstenen Kalemler Listesi</a>
                   </h4>
               </div>
               <div id="collapse4" class="panel-collapse collapse">
                   <div class="panel-body">
                       <table class="table" >
                           <thead id="tasks-list" name="tasks-list">
                               <tr id="firma{{$firma->id}}">
                               <tr>
                                   <td></td> 
                                   <td></td>
                               </tr>
                               <tr>
                                   <td></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td></td>
                                   <td></td>
                               </tr>
                               </tr>
                           </thead>
                       </table>
                       <div class="modal fade" id="myModal-fiyatKalemler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Fiyat İstenen Kalemler Listesi</h4>
                                   </div>
                                   <div class="modal-body">
                                       {!! Form::open(array('url'=>'firmaIlanOlustur/fiyatKalemler/'.$firma->id,'class'=>'form-horizontal','method'=>'POST', 'files'=>true)) !!}

                                       <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">KDV</label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" class="filled-in" id="filled-in-box" name="kdv" checked="checked" />  
                                            </div>
                                        </div>
                                     <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Ödeme Türü</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="odeme_turu" id="odeme_turu" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($odeme_turleri as $odeme_turu)
                                                   <option  value="{{$odeme_turu->id}}" >{{$odeme_turu->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputEmail3" class="col-sm-3 control-label">Para Birimi</label>
                                           <div class="col-sm-9">
                                               <select class="form-control" name="para_birimi" id="para_birimi" required>
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($para_birimleri as $para_birimi)
                                                   <option  value="{{$para_birimi->id}}" >{{$para_birimi->adi}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                       {!! Form::submit('Kaydet', array('url'=>'firmaIlanOlustur/fiyatKalemler/'.$firma->id,'class'=>'btn btn-danger')) !!}
                                       {!! Form::close() !!}
                                   </div>
                                   <div class="modal-footer">                                                            
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button id="btn-add-fiyatKalemler" name="btn-add-fiyatKalemler" class="btn btn-primary btn-xs" >Ekle / Düzenle</button>
                   </div>
               </div>
           </div>

       </div>
  </div>
<script>
  
$(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        
        $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="form-control" name="firmanin_urettigi_markalar[]"/><a href="#" class="remove_field"><i class="large material-icons">delete</i></a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        });
                                               
        $( "#yayinlama_tarihi" ).datepicker(
            showOn: "button",
            buttonImage: "/checkbook/public/overcast/images/calendar19.gif",  // put in an image to click on
            buttonImageOnly: true,
            dateFormat: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
                                                                                    
        );
      $( "#kapanma_tarihi" ).datepicker(
            showOn: "button",
            buttonImage: "/checkbook/public/overcast/images/calendar19.gif",  // put in an image to click on
            buttonImageOnly: true,
            dateFormat: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
                                                                                    
        );
     $( "#is_baslama_tarihi" ).datepicker(
            showOn: "button",
            buttonImage: "/checkbook/public/overcast/images/calendar19.gif",  // put in an image to click on
            buttonImageOnly: true,
            dateFormat: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
                                                                                    
    );
     $( "#is_bitis_tarihi" ).datepicker(
            showOn: "button",
            buttonImage: "/checkbook/public/overcast/images/calendar19.gif",  // put in an image to click on
            buttonImageOnly: true,
            dateFormat: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
                                                                                    
        );
});



var selectDD(){
        fillIlce({{$firmaAdres->iller->id}});
        fillSemt({{$firmaAdres->ilceler->id}});
        $("#il_id").val({{$firmaAdres->iller->id}});
        $("#ilce_id").val({{$firmaAdres->ilceler->id}});
        $("#semt_id").val({{$firmaAdres->semtler->id}});
}
        /*alert("doluyum ben");
        popDropDown('ilce_id', 'ajax-subcat?il_id=', {{$firmaAdres->iller->id}});
        popDropDown('semt_id', 'ajax-subcatt?ilce_id=', {{$firmaAdres->ilceler->id}});
        $("#il_id").val({{$firmaAdres->iller->id}});
        $("#ilce_id").val({{$firmaAdres->ilceler->id}});
        alert("seçtim");
        
    */


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

