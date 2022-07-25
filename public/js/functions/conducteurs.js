$(function () {

    var modal = document.getElementById("myModal");

    $(document).on('click', '.scan-icon', function () {
        // Get the modal


        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = this;
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = this.src;

        // Get the <span> element that closes the modal
        // var span = document.getElementsByClassName("close")[0];

        // // When the user clicks on <span> (x), close the modal
        // span.onclick = function () {

        // }
    })
    $(document).on('click', '.close', function () {
        modal.style.display = "none";
    })

    $(document).on('click', '#deleteConducteurBtn', function () {
        var conducteur_id = $(this).data('id');
        // var modal1 = document.getElementById("deleteConducteur");
        // $('#deleteConducteur').modal('show');
        Swal.fire({
            title: 'Êtes vous sûr ?',
            text: 'Vous voulez supprimer ce conducteur',
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
                    url:'/deleteConducteur/'+conducteur_id,
                    method:'POST',
                    success:function(data){
                        if (data.code == 0) {
                            toastr.error(data.msg);
                        } else {
                            toastr.success(data.msg);
                            window.location = '/conducteurs-list';
                        }
                    }
                })
            }
        })
    })

})
