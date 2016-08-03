@extends('layouts.app')
@section ('content')
<div class="col-lg-6">
    
    <div class="form-group">
        <h1>Firma Profili</h1>
        <div class="form-group">
            <script>alert ({{$firma->adi}}) </script>
            
            {{$firma->adi}}
        </div>
        
        
        <br>
        <div class="form-group">
            
        </div>        

</div>

@endsection
