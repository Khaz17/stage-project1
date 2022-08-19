@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/modal.css') }}">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">

        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::get('fail'))
            <div class="alert alert-success">
                {{ Session::get('fail') }}
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center"
                    href="{{ url('/editVehicule/' . $vehicule[0]->id) }}">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Modifier véhicule
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" data-toggle="modal" href="javascript:void(0)"
                    data-target="#deleteVehicule" data-id="{{$vehicule[0]->id}}" id="deleteVehiculeBtn">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-danger">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-danger mb-0">
                            Supprimer véhicule
                        </p>
                    </div>
                </a>
            </div>

        <!-- END Quick Actions -->

        <!-- User Info -->
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    {{-- <div class="mb-3">
                        <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">
                    </div> --}}
                    <p class="fs-sm fw-medium text-muted mb-3">Véhicule #{{ $vehicule[0]->id }}</p>
                    <h1 class="fs-lg mb-0">
                        <span>{{ $vehicule[0]->immatriculation }}</span>
                    </h1>
                    <p class="fs-sm fw-medium text-muted">{{ $vehicule[0]->nom_m }} {{ $vehicule[0]->libelle_m }}</p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">ACQUIS LE</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ date('d/m/Y', strtotime($vehicule[0]->date_acquisition)) }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">GAINS GÉNÉRÉS</div>
                        @if ($gg === 0)
                            <p>[ ]</p>
                        @else
                            <p class="fs-3 text-primary" href="#">{{ number_format($gg, 2, ',', ' ') }} FCFA</p>
                        @endif
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Usage</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $vehicule[0]->libelle_u }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Affecté à</div>
                    @if (count($conducteur) === 0)
                        Non affecté
                    @else
                        <a class="link-fx fs-3 text-primary" href="{{ route('get.conducteur.details',['id'=>$conducteur[0]->conducteur_id]) }}">{{ $conducteur[0]->nom_c}} {{ $conducteur[0]->prenom_c}}</a>
                    @endif
                        {{-- <a class="link-fx fs-3 text-primary" href="{{ route('get.conducteur.details',['id'=>$vehicule[0]->conducteur_id]) }}">{{ $vehicule[0]->nom_c }} {{ $vehicule[0]->prenom_c }}</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Info -->

        <!-- Addresses -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Informations</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Billing Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">USINE</h3>
                            </div>
                            <div class="block-content">
                                {{-- <div class="fs-4 mb-1">John Parker</div> --}}
                                <address class="fs-sm">
                                    Numéro de châssis : {{ $vehicule[0]->numero_chassis }}<br>
                                    Type de moteur : {{ $vehicule[0]->libelle_tm }}<br>
                                    Modèle : {{ $vehicule[0]->libelle_m }} ({{ $vehicule[0]->nom_m }}) <br>
                                    Nombre de places : {{ $vehicule[0]->nbre_places }}</a>
                                </address>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">UTILISATION</h3>
                            </div>
                            <div class="block-content">
                                <address class="fs-sm">
                                    Date d'acquisition : {{ date('d/m/Y', strtotime($vehicule[0]->date_acquisition)) }}<br>
                                    Prix d'acquisition : {{ number_format($vehicule[0]->prix_acquisition, 2, ',', ' ') }} FCFA<br>
                                    Consommation de base : {{ $vehicule[0]->consommation_de_base }} l/km<br>
                                    Recette hebdomadaire attendue : {{ number_format($vehicule[0]->recette_hebdo_attendue, 2, ',', ' ') }} FCFA
                                </address>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Bilans journaliers -->
        @if (count($bjs) > 0)
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Bilans journaliers du véhicule</h3>
                </div>
                <div class="block-content">
                    <div id="bjs-table" class="p-2">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Date</th>
                                    <th>Recette</th>
                                    <th>Kilométrage</th>
                                    <th>Essence consommée</th>
                                    <th>Conducteur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bjs as $bj)
                                    <tr>
                                        {{-- <td>{{ $bj[0]->id }}</td> --}}
                                        <td>{{ date('d/m/Y', strtotime($bj->date_bilan)) }}</td>
                                        <td>{{ number_format($bj->recette_journaliere, 2, ',', ' ') }} F CFA</td>
                                        <td>{{ number_format($bj->kilometrage, 2, ',', ' ') }}</td>
                                        <td>{{ $bj->qte_essence_consommee }}</td>
                                        <td>{{ $bj->nom_c }} {{ $bj->prenom_c }}</td>
                                        <td>
                                            {{-- <div class="btn-group">
                                                <a type="button" class="btn btn-sm btn-alt-success" href="{{ url('/getConducteurDetails/'.$conducteur->id) }}" id="showConducteurDetails" data-bs-toggle="tooltip" title="Afficher détails conducteur"><i class="far fa-fw fa-eye"></i></a>
                                                <button type="button" class="btn btn-sm btn-alt-danger" data-id="{{ $conducteur->id }}" id="deleteConducteurBtn" data-bs-toggle="tooltip" title="Supprimer conducteur">
                                                <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('js/functions/vehicules.js') }}"></script>

    </div>
@endsection
