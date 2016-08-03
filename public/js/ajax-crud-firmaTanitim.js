$(document).ready(function(){

    var url = "/tamrekabet/public/index.php/firma";
   
    //display modal form for task editing
    $('.open-modal-tanıtımyazısı').click(function(){
        var firma_id = $(this).val();

        $.get(url + '/' + firma_id, function (data) {
            //success data
            console.log(data);
            $('#firma_id').val(data.id);
            $('#tanıtım_yazısı').val(data.tanıtım_yazısı);
            
            $('#btn-save-tanıtımyazısı').val("update");

            $('#myModal-tanıtımyazısı').modal('show');
            
        }) 
    });
        //display modal form for task editing
   

    //display modal form for creating new task
    $('#btn-add-tanıtımyazısı').click(function(){
        $('#btn-save-tanıtımyazısı').val("add");
        $('#frmTanıtımYazısı').trigger("reset");
        $('#myModal-tanıtımyazısı').modal('show');
    });

    
});