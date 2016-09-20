@extends('layouts.app')
 @section('content')
    <style>
           input[type=text] {
               width: 200px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 16px;
               background-color: white;
               background-image: url("{{asset('images/search.png')}}");
               background-position: 10px 10px;
               background-repeat: no-repeat;
               padding: 12px 20px 12px 40px;
               -webkit-transition: width 0.4s ease-in-out;
               transition: width 0.4s ease-in-out;
           }

           input[type=button] {
               background-color: #63b8ff;
               border: 2px solid #ccc;
               color: white;
               border-radius: 4px;
              padding: 12px 8px 12px 8px;
               text-decoration: none;
               margin: 4px 2px;
              
           }
           .header{
               background-color: #f5f5f5;
               width: 100%;
               height: 100px;
               
           }
           .search{
               width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 12px;
               background-color:#C0C0C0;
               padding: 12px 8px 12px 8px;
               
           }
           .soldivler{
                width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 12px;
               background-color: #f5f5f5;
               padding: 12px 8px 12px 8px;
               
           }
       
           
   </style>
    <hr>
      <div class="header">
          
             
      </div>
     <hr>
     <div class="container">
      

       
       <div class="container-fluid" style="width:100%">
              <div class="row content" style="padding-top: 0px" >
                 <div class="col-sm-3">
                     
                     
                     <div class="search">
                                <div>
                                    <input type="text" name="search" placeholder="Anahtar Kelime"><input type="button"  value="ARA">
                                </div>
                                <div>
                                   <input type="radio" name="gender" value="male"> Tüm İlanda<br>
                                   <input type="radio" name="gender" value="female"> Sadece İlan Başlığında<br>
                                   <input type="radio" name="gender" value="other"> Sadece Firma Adında Ara
                                </div>  
                     </div>
                     <br>
                     <div class="soldivler">
                         <form >
                             <h4>İllerde Arama</h4>
                             <select class="form-control" name="il_id" id="il_id" onchange="window.location='{{ URL::to('/ilanAra/?il_id=') }}'"  required >
                                                   <option selected disabled>Seçiniz</option>
                                                   @foreach($iller as $il)
                                                   <option  value="{{$il->id}}"  >{{$il->adi}}</option>
                                                   @endforeach
                            </select>
                         </form>
                     </div>
                     <div class="soldivler">
                         
                             <h4>İlan Tarihi Aralığı</h4>
                             <p>Başlangıç Tarihi</p>
                              <input type="date" class="form-control datepicker" id="baslangic_tarihi" name="baslangic_tarihi" placeholder="" value="">
                                  <br>
                             <p>Bitiş Tarihi</p>
                              <input type="date" class="form-control datepicker" id="bitis_tarihi" name="bitis_tarihi" placeholder="" value="">
                      
                     </div>
                     <div class="soldivler">
                         
                             <h4>İlan Sektörü</h4>
                             @foreach($sektorler as $sektor)
                              <input type="checkbox" value="{{$sektor->id}}"> {{$sektor->adi}}<br>
                             @endforeach
                      
                     </div>
                     <div class="soldivler">
                         
                             <h4>İlan Türü</h4>
                             <input type="checkbox"><span class="lever"></span>Mal<br>
                             <input type="checkbox"><span class="lever"></span>Hizmet<br>
                             <input type="checkbox"><span class="lever"></span>Yapım İşi
                     </div>
                     <div class="soldivler">
                             <h4>İlan Usulü</h4>
                              <input type="radio" name="acik" value="Açık"> Açık<br>
                              <input type="radio" name="belirli" value="Belirli İstekler Arasında">Belirli İstekler Arasında<br>
                              <input type="radio" name="basvuru" value="Başvuru">Başvuru
                     </div>
                     
                            
                            
                 </div>
                 <div class="col-sm-9">
                     
                     
                     <h3>İlanlar</h3>
                     <hr>
                     @foreach($query as $query)
                     <p>{{$query->adi}}</p>
                     <p>{{$query->firmalar->adi}}</p>
                     <hr>
                     @endforeach
                    
                     
                    
                 </div>
                  
        <hr>
    </div>
  
@endsection

