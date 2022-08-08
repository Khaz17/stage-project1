$(function(){
    $('#vehicule').change(function(){
        var select = this;
        var id = select.options[select.selectedIndex].value;
        var url = '/getAffectedConducteur/'+id;

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                if(response != null){
                    if (response.conducteur[0] != null) {
                        document.getElementById('info_c').innerText = response.conducteur[0].nom_c + ' ' + response.conducteur[0].prenom_c
                        document.getElementById('conducteur').value = response.conducteur[0].conducteur_id;
                    } else {
                        document.getElementById('info_c').innerText = 'Conducteur'
                    }

                } else {
                    alert('Empty');
                }
            },
        })
    })

    $(document).on('click', '#showDetails', function(){
        var bj_id = $(this).data('id');
        $.get('/getBilanJournalierDetails/'+bj_id, function(data) {
            // console.log(data);
            var k = data.kilometrage;
            var rj = data.recette_journaliere;
            rj = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XOF' }).format(rj);
            $('.detailsBj').find('b[name="kilometrage"]').text(k.toLocaleString('fr-FR'));
            $('.detailsBj').find('b[name="qteec"]').text(data.qte_essence_consommee);
            $('.detailsBj').find('b[name="rj"]').text(rj);
            $('.detailsBj').find('b[name="v"]').text(data.immatriculation);
            $('.detailsBj').find('b[name="c"]').text(data.nom_c+' '+data.prenom_c);
            $('.detailsBj').modal('show');
        })
    })

})
