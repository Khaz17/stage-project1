<div class="modal fade editMarque" id="modal-block-popout" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Modifier marque</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('update.marque.details' )}}" method="post" id="edit-marque-form">
                    <div class="block-content fs-sm">
                        @csrf
                        <input type="hidden" name="mid">
                        <div class="form-group">
                            <label for="nom_m">Libellé</label>
                            <input class="form-control" type="text" name="nom_m" id="nom_m">
                            <span class="text-danger error-text nom_m_error"></span>
                        </div>
                        <br>
                    </div>
                    <div class="block-content block-content-full text-end bg-body form-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm btn-primary">Confirmer</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
