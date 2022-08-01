@extends('layouts.backend')

@section('content')

    @if (Session::get('success'))
    <div class="alert alert-success">
        {{ Session::get('success')}}
    </div>
    @endif

    @if (Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail')}}
    </div>
    @endif

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Liste des bilans journaliers
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
                            Liste des bilans journaliers
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
                    BILANS DE LA JOURNÉE
                </h3>
            </div>
            <div class="block-content">
                <div id="affectations-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Véhicule concerné</th>
                                <th>Conducteur</th>
                                <th>Date de réalisation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($affectations as $affectation)
                                <tr>
                                    <td>{{ $affectation->id }}</td>
                                    <td><a href="{{ route('get.vehicule.details',['id'=>$affectation->vehicule_id]) }}">{{ $affectation->immatriculation }}</a></td>
                                    <td><a href="{{ route('get.conducteur.details',['id'=>$affectation->conducteur_id]) }}">{{ $affectation->nom_c }} {{ $affectation->prenom_c }}</a></td>
                                    <td>{{ date('d/m/Y H:i', strtotime($affectation->date_realisation)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="{{ $affectation->id }}" id="disableAffectationBtn" data-bs-toggle="tooltip" title="Désactiver affectation">
                                                <i class="fa fa-fw fa-toggle-off"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END Your Block -->

    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/functions/bilansjournaliers.js') }}"></script>

@endsection
