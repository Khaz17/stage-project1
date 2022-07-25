{{-- <div class="modal fade deleteConducteur" id="deleteConducteur" tabindex="-1" role="dialog"
    aria-labelledby="deleteConducteur" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Êtes-vous sûr ?</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <p>Vous voulez supprimer cette marque.</p>

                <a href="{{ url('/deleteConducteur/' . $conducteur->id) }}" class="btn btn-sm btn-danger">

            </div>
        </div>
    </div>
</div> --}}
<!-- Pop Out Block Modal -->
<div class="modal fade" id="deleteConducteur" tabindex="-1" role="dialog" aria-labelledby="deleteConducteur"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Êtes-vous sûr ?</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <p>Vous voulez supprimez ce conducteur.</p>
                    {{-- <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                        luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor
                        tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum
                        quis in sit varius lorem sit metus mi.</p> --}}
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Perfect</button> --}}
                    <a href="{{ url('/deleteConducteur/' . $conducteur->id) }}" class="btn btn-sm btn-danger"></a>

                </div>
            </div>
        </div>
    </div>
</div>
