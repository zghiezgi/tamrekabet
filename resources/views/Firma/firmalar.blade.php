@extends('layouts.app')
@section ('content')
<div class="col-lg-6">
    <div class="form-group">
        <h1>Firmalar</h1>
        <div>
            <table>
            <?php $i = 1; ?>
            @foreach($firmalar as $firma)
            <tr>
                <td>{{$i}}</td>&nbsp;&nbsp;
                <td>{{$firma->adi}}</td>&nbsp;&nbsp;
                <td><a href="{{ url('firma/'.$firma->id)}}">Tıkla</a>
            </tr>
            <?php $i++; ?>
            @endforeach
            </table>
        </div>
        
        <br>
        <div class="form-group">
        </div>        
    </div>
</div>

@endsection
