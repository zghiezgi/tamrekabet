$(document).ready(function(){

    var url = "/tamrekabet/public/index.php/firma";
   
    //display modal form for task editing
    $('.open-modal-image').click(function(){
        var firmalar_id = $(this).val();
        $.get(url + '/' + firmalar_id, function (data) {
            //success data
            console.log(data);
            $('#firmalar_id').val(data.id);
            $('#btn-save').val("update");
            $('#myModal-image').modal('show');            
        }) 
    });
        //display modal form for task editing
   

    //display modal form for creating new task
    $('#btn-add-image').click(function(){
        $('#btn-save-image').val("add");
        $('#frmImage').trigger("reset");
        $('#myModal-image').modal('show');
    });

    //delete task and remove it from list
    $('.delete-image').click(function(){
        var firmalar_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + firmas_id,
            success: function (data) {
                console.log(data);

                $("#firmalar" + firmalar_id).remove(); //task yerine ne yazmam lazım ?? o task html adı???
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save-image").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
               
            }
        });

        e.preventDefault(); 

        var formData = {
           //kaydedilecek seyleri buraya yaz .
           
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save-image').val();

        var type = "POST"; //for creating new resource
        var firmalar_id = $('#firmalar_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + firmalar_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

               
                $('#frmImage').trigger("reset");

                $('#myModal-image').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});