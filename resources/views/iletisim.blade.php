@extends('layouts.app')
@section ('content')
<div class="col-lg-6">
    {!! Form::open(array('url'=>'form' ,'method' => 'POST','files'=>true))!!}
    <div class="form-group">
        <h1>İletişim Bilgileri</h1>
        <div class="form-group">
            {!! Form::label('Telefon') !!}
            {!! Form::text('telefon', null, array('required', 'class'=>'form-control', 'placeholder'=>'(5xx) xxx xx xx')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Fax') !!}
            {!! Form::text('fax', null, array('required', 'class'=>'form-control', 'placeholder'=>'(xxx) xxx xx xx')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Web Sayfası') !!}
            {!! Form::text('web_sayfasi', null, array('required', 'class'=>'form-control', 'placeholder'=>'Web sayfası')) !!}
        </div>
        <div>
            <label for="">Şehir</label>
            <select class="form-control input-sm" name="city_id" id="city_id" required>
                <option selected disabled>Seçiniz</option>
                @foreach($iller as $il)
                <option value="{{$il->id}}">{{$il->adi}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">İlçe</label>
            <select class="form-control input-sm" name="district_id" id="district_id" required>
                <option selected disabled>Seçiniz</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Semt</label>
            <select class="form-control input-sm" name="neighborhood_id" id="neighborhood_id" required>
                <option selected disabled>Seçiniz</option>
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('Posta Kodu') !!}
            {!! Form::text('posta_kodu', null, array('required', 'class'=>'form-control', 'placeholder'=>'Posta Kodu')) !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::submit('Kaydet!', 
            array('class'=>'btn btn-primary')) !!}
        </div>        
    </div>
    {!!Form::close()!!}
</div>

<script>
$('#city_id').on('change', function (e) {
    console.log(e);

    var city_id = e.target.value;

    //ajax
    $.get('/tamrekabet/public/index.php/ajax-subcat?city_id=' + city_id, function (data) {
        //success data
        //console.log(data);
        $('#district_id').empty();
         $('#district_id').append('<option value=""> Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#district_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    });
});

$('#district_id').on('change', function (e) {
    console.log(e);

    var district_id = e.target.value;

    //ajax
    $.get('/tamrekabet/public/index.php/ajax-subcatt?district_id=' + district_id, function (data) {
        //success data
        //console.log(data);
        $('#neighborhood_id').empty();
        $('#neighborhood_id').append('<option value=" ">Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#neighborhood_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    });
});
$('#neighborhood_id').on('change', function (e) {
    console.log(e);

    var neighborhood_id = e.target.value;

    //ajax
    $.get('/tamrekabet/public/index.php/ajax-subcattt?neighborhood_id=' + neighborhood_id, function (data) {
        //success data
        //console.log(data);
        $('#neighborhood_id').empty();
        $.each(data, function (index, subcatObj) {
            $('#neighborhood_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    });
});

</script>

@endsection