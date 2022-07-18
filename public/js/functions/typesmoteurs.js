$(function(){
    var table = $('#typesmoteurs-table table').DataTable({
        processing:true,
        info:true,
        ajax:"/getTypemoteursList",
        columns:[
            {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
            {data:'id', name:'id'},
            {data:'libelle_tm', name:'libelle_tm'},
            {data:'actions', name:'actions', orderable:false, searchable:false},
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
                $(form).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                } else {
                    table.ajax.reload(null, false);
                    $('.editTypemoteur').modal('hide');
                    $('.editTypemoteur').find('form')[0].reset();
                    toastr.success(data.msg);
                }
            },
        });
    });

    //Supprimer type moteur
    $(document).on('click','#deleteTypemoteurBtn', function(){
        var typemoteur_id = $(this).data('id');
        var url = "/deleteTypemoteur";

        swal.fire({
            title:'Êtes-vous certain ?',
            html:'Vous voulez <b>supprimer</b> ce type de moteur.',
            showCancelButton:true,
            showCloseButton:true,
            cancelButtonText:'Annuler',
            confirmButtonText:'Oui, Supprimer',
            cancelButtonColor:'#d33',
            confirmButtonColor:'#556ee6',
            width:300,
            allowOutsideClick:false
        }).then(function(result){
            if(result.value){
                // $.post('/deleteTypemoteur', {typemoteur_id : typemoteur_id}, function(data){
                //     if(data.code == 1){
                //         table.ajax.reload(null, false);
                //         toastr.success(data.msg);
                //     }else{
                //         toastr.error(data.msg);
                //     }
                // },'json');
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/deleteTypemoteur',
                    method:'POST',
                    data: {typemoteur_id:typemoteur_id},
                    dataType:'json',
                    success:function(data){
                        if (data.code == 0) {
                            toastr.error(data.msg);
                        } else {
                            table.ajax.reload(null, false);
                            toastr.success(data.msg);
                        }
                    }
                })
             }
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

    });

});

toastr.options.preventDuplicates = true;

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
