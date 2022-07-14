{{-- @foreach ($marques as $marque)
    {{ $marque->id }}
    {{ $marque->nom_m }}
@endforeach --}}

@extends('layouts.listing')

@section('content')
    <!-- Title -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Modèles de voitures
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Modèles de voitures
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
            <div class="row block-content block-content-full">
                <div class="col-md-8">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                    <div id="modeles-table">
                        <table class="table table-bordered table-vcenter table-striped table-responsive fs-sm">
                            <thead>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Libellé</th>
                                <th>Marque</th>
                                <th>Actions</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Ajouter un nouveau modèle</div>
                        <div class="card-body">
                            <form action="{{ route('add.modele') }}" method="post" id="add-modele-form">
                                @csrf
                                <div class="form-group">
                                    <label for="libelle_m" class="form-label">Libellé</label>
                                    <input class="form-control" type="text" name="libelle_m" id="libelle_m">
                                    <span class="text-danger error-text libelle_m_error"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="marque" class="form-label">Marque</label>
                                    <select class="form-select" name="marque" id="marque">
                                        <option value="0"></option>
                                        @foreach ($marques as $marque)
                                            <option value="{{ $marque->id }}">{{$marque->nom_m}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text marque_error"></span>
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

            @include('modeles.edit-modele-modal')
            <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
            <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('datatables/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('js/functions/modeles.js') }}"></script>

            <script></script>
        </div>
    </div>
    </div>
@endsection
