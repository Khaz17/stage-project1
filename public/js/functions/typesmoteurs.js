$(function(){
    var table = $('#typesmoteurs-table table').DataTable({
        processing:true,
        info:true,
        ajax:"/getTypemoteursList",
        columns:[
            {data:'id', name:'id'},
            {data:'libelle_tm', name:'libelle_tm'},
            {data:'actions', name:'actions'},
        ]
    })

    $(document).on('click','#editTypemoteurBtn', function(){
        var typemoteur_id = $(this).data('id');

        $('.editTypemoteur').find('form')[0].reset();
        $('.editTypemoteur').find('span.error-text').text('');
        $.get('/getTypemoteurDetails', {typemoteur_id : typemoteur_id}, function(data){
            // alert(data.result.libelle_tm);
            $('.editTypemoteur').find('input[name="tmid"]').val(data.result.id);
            $('.editTypemoteur').find('input[name="libelle_tm"]').val(data.result.libelle_tm);
            $('.editTypemoteur').modal('show');
        },'json');
        // alert(typemoteur_id);

    })


    // Modifier type moteur
    $('#edit-typemoteur-form').on('submit', function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function(){

            },
            success: function(data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                } else {
                    $('editTypemoteur').modal('hide');
                    $('editTypemoteur').find('form')[0].reset();
                }
            },
            // error: function(xhr) {
            //     alert('Ewo')
            // }
        });
    });



    //Ajouter type moteur
    $('#add-typemoteur-form').on('submit', function(e){
        e.preventDefault();
        var form = this;

        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data: new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    })
                } else {
                    $(form)[0].reset();
                    toastr.success(data.msg);
                    table.ajax.reload();
                }

            }
        })

        //
    });

});

toastr.options.preventDuplicates = true;

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
