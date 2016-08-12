$(document).ready(function(){


    $('#btn-add-firmaBilgilerim').click(function () {
        $('#btn-save-firmaBilgilerim').val("add");
        $('#myModal-firmaBilgilerim').modal('show');
    });
    $('#btn-add-ilanBilgileri').click(function () {
        $('#btn-save-ilanBilgileri').val("add");
        $('#myModal-ilanBilgileri').modal('show');
    });
      $('#btn-add-fiyatlandırmaBilgileri').click(function () {
        $('#btn-save-fiyatlandırmaBilgileri').val("add");
        $('#myModal-fiyatlandırmaBilgileri').modal('show');
    });
      $('#btn-add-fiyatKalemler').click(function () {
        $('#btn-save-fiyatKalemler').val("add");
        $('#myModal-fiyatKalemler').modal('show');
    });
});

