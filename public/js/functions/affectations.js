$(function(){
    $(document).on('click', '#disableAffectationBtn', function () {
        var affectation_id = $(this).data('id');
        Swal.fire({
            title: 'Êtes vous sûr ?',
            text: 'Vous voulez désactiver cette affectation',
            icon: 'warning',
            confirmButtonText: 'Désactiver',
            cancelButtonText: 'Annuler',
            showCancelButton: true,
            showCloseButton: true
        }).then(function(result){
            if(result.value){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/disableAffectation/'+affectation_id,
                    method:'POST',
                    success:function(data){
                        if (data.code == 0) {
                            toastr.error(data.msg);
                        } else {
                            toastr.success(data.msg);
                            window.location = '/affectations-list';
                        }
                    }
                })
            }
        })
    })
})
