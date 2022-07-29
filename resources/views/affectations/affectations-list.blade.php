@extends('layouts.listing')

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
                        Liste des affectations
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
                            Liste des affectations
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
                    AFFECTATIONS ENCORE EN VIGUEUR
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
                            @foreach ($affectations as $affectation)
                                <tr>
                                    <td>{{ $affectation->id }}</td>
                                    <td><a href="{{ route('get.vehicule.details',['id'=>$affectation->vehicule_id]) }}">{{ $affectation->immatriculation }}</a></td>
                                    <td><a href="{{ route('get.conducteur.details',['id'=>$affectation->conducteur_id]) }}">{{ $affectation->nom_c }} {{ $affectation->prenom_c }}</a></td>
                                    <td>{{ date('d/m/Y H:i', strtotime($affectation->date_realisation)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- <a type="button" class="btn btn-sm btn-alt-success" href="{{ url('/getVehiculeDetails/'.$vehicule->id) }}" id="showVehiculeDetails" data-bs-toggle="tooltip" title="Afficher détails véhicule"><i class="far fa-fw fa-eye"></i></a> --}}
                                            <button type="button" class="btn btn-sm btn-alt-danger" data-id="{{ $affectation->id }}" id="disableAffectationBtn" data-bs-toggle="tooltip" title="Désactiver affectation">
                                                <i class="fa fa-fw fa-toggle-off"></i>
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

        <!-- Second Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    AFFECTATIONS ARRIVÉES À TERME
                </h3>
            </div>
            <div class="block-content">
                <div id="old-affectations-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Véhicule concerné</th>
                                <th>Conducteur</th>
                                <th>Date de l'affectation</th>
                                <th>Date de fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oldaffectations as $oldaffectation)
                                <tr>
                                    <td scope="row">{{ $oldaffectation->id }}</td>
                                    <td><a href="{{ route('get.vehicule.details', ['id' => $oldaffectation->vehicule_id])}}">{{$oldaffectation->immatriculation}}</a></td>
                                    <td><a href="{{ route('get.conducteur.details', ['id' => $oldaffectation->conducteur_id])}}">{{$oldaffectation->nom_c}} {{$oldaffectation->prenom_c}}</a></td>
                                    <td>{{ date('d/m/Y H:i', strtotime($oldaffectation->date_realisation)) }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($oldaffectation->date_fin)) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/functions/affectations.js') }}"></script>

@endsection
