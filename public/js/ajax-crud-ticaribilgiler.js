$(document).ready(function(){

    var url = "/laravelform/public/index.php/commucations";
   
    //display modal form for task editing
    $('.open-modal-ticaribilgiler').click(function(){
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
            
            
            $('#btn-save-ticaribilgiler').val("update");

            $('#myModal-ticaribilgiler').modal('show');
            
        }) 
    });
        //display modal form for task editing
   

    //display modal form for creating new task
    $('#btn-add-ticaribilgiler').click(function(){
        $('#btn-save-ticaribilgiler').val("add");
        $('#frmTicariBilgiler').trigger("reset");
        $('#myModal-ticaribilgiler').modal('show');
    });

    
});
