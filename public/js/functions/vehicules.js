$(function(){
    $(document).on('click', '#deleteVehiculeBtn', function () {
        var vehicule_id = $(this).data('id');
        Swal.fire({
            title: 'Êtes vous sûr ?',
            text: 'Vous voulez supprimer ce véhicule',
            icon: 'warning',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            showCancelButton: true,
            showCloseButton: true
        }).then(function(result){
            if(result.value){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/deleteVehicule/'+vehicule_id,
                    method:'POST',
                    success:function(data){
                        if (data.code == 0) {
                            toastr.error(data.msg);
                        } else {
                            toastr.success(data.msg);
                            window.location = '/vehicules-list';
                        }
                    }
                })
            }
        })
    })
})
