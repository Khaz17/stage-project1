$(function(){
    var table = $('#modeles-table table').DataTable({
        processing:true,
        info:true,
        ajax:"/getModelesList",
        columns:[
            {data:'id', name:'id'},
            {data:'libelle_m', name:'libelle_m'},
            {data:'nom_m', name:'nom_m'},
            {data:'actions', name:'actions'},
        ]
    })
    // document.onload(getModeles());
    // function getModeles(){
    //     $.get('/getModelesList', function(data){

    //     },'json');
    // }

    $(document).on('click','#editModeleBtn', function(){
        var modele_id = $(this).data('id');

        $('.editModele').find('form')[0].reset();
        $('.editModele').find('span.error-text').text('');
        $.get('/getModeleDetails', {modele_id : modele_id}, function(data){
            $('.editModele').find('input[name="mrid"]').val(data.result.id);
            $('.editModele').find('input[name="libelle_m"]').val(data.result.libelle_m);
            $('.editModele').find('select[name="marque"]').val(data.result.marque_id);
            $('.editModele').modal('show');
        },'json');
    })


    // Modifier modèle
    $('#edit-modele-form').on('submit', function(e){
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
                    toastr.warning(data.msg);
                } else {
                    table.ajax.reload(null, false);
                    $('.editModele').modal('hide');
                    $('.editModele').find('form')[0].reset();
                    toastr.success(data.msg);
                }
            },
            error: function(){
                alert('Error!')
            }
        });
    });

    //Supprimer modèle
    $(document).on('click','#deleteModeleBtn', function(){
        var modele_id = $(this).data('id');
        var url = "/deleteModele";

        swal.fire({
            title:'Êtes-vous certain ?',
            html:'Vous voulez <b>supprimer</b> ce modèle.',
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
                    url:'/deleteModele',
                    method:'POST',
                    data: {modele_id:modele_id},
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

    //Ajouter modèle
    $('#add-modele-form').on('submit', function(e){
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
                    toastr.warning(data.msg);
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
