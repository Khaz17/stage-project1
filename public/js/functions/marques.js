$(function(){
    var table = $('#marques-table table').DataTable({
        processing:true,
        info:true,
        ajax:"/getMarquesList",
        columns:[
            {data:'id', name:'id'},
            {data:'nom_m', name:'nom_m'},
            {data:'actions', name:'actions'},
        ]
    })

    $(document).on('click','#editMarqueBtn', function(){
        var marque_id = $(this).data('id');

        $('.editMarque').find('form')[0].reset();
        $('.editMarque').find('span.error-text').text('');
        $.get('/getMarqueDetails', {marque_id : marque_id}, function(data){
            $('.editMarque').find('input[name="mid"]').val(data.result.id);
            $('.editMarque').find('input[name="nom_m"]').val(data.result.nom_m);
            $('.editMarque').modal('show');
        },'json');
    })


    // Modifier marque
    $('#edit-marque-form').on('submit', function(e){
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
                    $('.editMarque').modal('hide');
                    $('.editMarque').find('form')[0].reset();
                    toastr.success(data.msg);
                }
            },
        });
    });

    //Supprimer marque
    $(document).on('click','#deleteMarqueBtn', function(){
        var marque_id = $(this).data('id');
        var url = "/deleteMarque";

        swal.fire({
            title:'Êtes-vous certain ?',
            html:'Vous voulez <b>supprimer</b> cette marque.',
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
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/deleteMarque',
                    method:'POST',
                    data: {marque_id:marque_id},
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

    //Ajouter marque
    $('#add-marque-form').on('submit', function(e){
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
