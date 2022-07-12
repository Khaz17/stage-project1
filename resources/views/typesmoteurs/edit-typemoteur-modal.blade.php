<div class="modal fade editTypemoteur" id="modal-block-popout" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Modifier type</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('update.typemoteur.details' )}}" method="post" id="edit-typemoteur-form">
                    <div class="block-content fs-sm">
                        @csrf
                        <input type="hidden" name="tmid">
                        <div class="form-group">
                            <label for="libelle_type">Libellé</label>
                            <input class="form-control" type="text" name="libelle_tm" id="libelle_tm">
                            <span class="text-danger error-text libelle_tm_error"></span>
                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Enregistrer</button>
                        </div> --}}
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
