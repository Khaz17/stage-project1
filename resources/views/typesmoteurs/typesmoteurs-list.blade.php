@extends('layouts.listing')

@section('content')

<!-- Title -->
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            Types de moteurs
          </h1>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">App</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Types de moteurs
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Title -->

  <div class="content">
   <!-- Dynamic Table Full -->
   <div class="block block-rounded">
    {{-- <div class="block-header block-header-default">
      <h3 class="block-title">
        Dynamic Table <small>Full</small>
      </h3>
    </div> --}}
    <div class="row block-content block-content-full">
        <div class="col-md-8">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div id="typesmoteurs-table">
                <table class="table table-bordered table-vcenter table-striped fs-sm">
                    <thead>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Ajouter un nouveau type</div>
                <div class="card-body">
                    <form action="{{ route('add.typemoteur' )}}" method="post" id="add-typemoteur-form">
                        @csrf
                        <div class="form-group">
                            <label for="libelle_type">Libellé</label>
                            <input class="form-control" type="text" name="libelle_tm" id="libelle_tm">
                            <span class="text-danger error-text libelle_tm_error"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('typesmoteurs.edit-typemoteur-modal')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/functions/typesmoteurs.js') }}"></script>

    {{-- <script>


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
    })
    </script> --}}
    <script>

    </script>
    </div>
   </div>
  </div>
@endsection
