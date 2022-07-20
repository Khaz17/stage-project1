@extends('layouts.listing')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Liste des conducteurs
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
                            Liste des conducteurs
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
                <div id="conducteurs-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Type de permis</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conducteurs as $conducteur)
                                <tr>
                                    <td>{{ $conducteur->id }}</td>
                                    <td>{{ $conducteur->nom_c }}</td>
                                    <td>{{ $conducteur->prenom_c }}</td>
                                    <td>{{ $conducteur->type_permis }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-sm btn-alt-success" href="{{ url('/getConducteurDetails/'.$conducteur->id) }}" id="showConducteurDetails" data-bs-toggle="tooltip" title="Afficher détails conducteur"><i class="far fa-fw fa-eye"></i></a>
                                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="{{ $conducteur->id }}" id="deleteConducteurBtn" data-bs-toggle="tooltip" title="Supprimer conducteur">
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
@endsection
