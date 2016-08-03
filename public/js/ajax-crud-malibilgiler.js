$(document).ready(function(){

    var url = "/tamrekabet/public/index.php/firma";
   
    //display modal form for task editing
    $('.open-modal-malibilgiler').click(function(){
        var malibilgiler_id = $(this).val();

        $.get(url + '/' + malibilgiler_id, function (data) {
            //success data
            console.log(data);
            $('#malibilgiler_id').val(data.id);
            $('#city_id').val(data.city_id);
            
            $('#district_id').val(data.district_id);
            $('#neighborhood_id').val(data.neighborhood_id);
            $('#adres').val(data.adres);
             $('#telefon').val(data.telefon);
            $('#fax').val(data.fax);
             $('#web_sayfası').val(data.web_sayfası);
            
            
            $('#btn-save-malibilgiler').val("update");

            $('#myModal-malibilgiler').modal('show');
            
        }) 
    });
        //display modal form for task editing
   

    //display modal form for creating new task
    $('#btn-add-malibilgiler').click(function(){
        $('#btn-save-malibilgiler').val("add");
        $('#frmMaliBilgiler').trigger("reset");
        $('#myModal-malibilgiler').modal('show');
    });
});