@extends('layouts.listing')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Liste des véhicules
                    </h1>
                    {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Subtitle
                    </h2> --}}
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Liste des véhicules
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    INFORMATIONS GÉNÉRALES
                </h3>
            </div>
            <div class="block-content">
                <div id="vehicules-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Numéro de châssis</th>
                                <th>Numéro d'immatriculation</th>
                                <th>Modèle</th>
                                <th>Marque</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicules as $vehicule)
                                <tr>
                                    <td>{{ $vehicule->id }}</td>
                                    <td>{{ $vehicule->numero_chassis }}</td>
                                    <td>{{ $vehicule->immatriculation }}</td>
                                    <td>{{ $vehicule->libelle_m }}</td>
                                    <td>{{ $vehicule->nom_m }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-alt-success" href="{{ url('/getVehiculeDetails/'.$vehicule->id) }}" id="showVehiculeDetails" data-bs-toggle="tooltip" title="Afficher détails véhicule"><i class="far fa-fw fa-eye"></i></a>
                                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="{{ $vehicule->id }}" id="deleteVehiculeBtn" data-bs-toggle="tooltip" title="Supprimer véhicule">
                                            <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->

    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/functions/vehicules.js') }}"></script>

@endsection
