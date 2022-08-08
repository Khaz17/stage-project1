@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Ajouter un nouveau véhicule
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Ajouter véhicule
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

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

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Informations du véhicule
                </h3>
            </div>
            <div class="block-content">
                <form action="{{ route('save.vehicule') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('modele') is-invalid @enderror" id="modele" name="modele" aria-label="Floating label select example" value="{{ old('modele') }}">
                                    <option value="0" selected>Choisissez une option</option>
                                    @foreach ($modeles as $modele)
                                        <option value="{{ $modele->id }}" {{ (old('modele') == $modele->id ? "selected":"") }}>{{ $modele->nom_m }} {{ $modele->libelle_m }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text">@error('modele') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="modele">Modèle de véhicule</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select @error('type_moteur') is-invalid @enderror" id="type_moteur" name="type_moteur" aria-label="Floating label select example" value="{{ old('type_moteur') }}">
                                    <option value="0" selected>Choisissez une option</option>
                                    @foreach ($types_moteurs as $type_moteur)
                                        <option value="{{ $type_moteur->id }}"{{ (old('type_moteur') == $type_moteur->id ? "selected":"") }}>{{ $type_moteur->libelle_tm }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text">@error('type_moteur') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="modele">Type de moteur</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('numero_chassis') is-invalid @enderror" id="numero_chassis" name="numero_chassis" placeholder="Doe" value="{{ old('numero_chassis') }}">
                                <span class="text-danger error-text fs-7">@error('numero_chassis') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="nom_c">Numéro de châssis</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control js-masked-matriculation-tg @error('immatriculation') is-invalid @enderror" id="immatriculation" name="immatriculation" placeholder="John" value="{{ old('immatriculation') }}">
                                <span class="text-danger error-text fs-7">@error('immatriculation') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="prenom_c">Numéro d'immatriculation</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('nbre_places') is-invalid @enderror" id="nbre_places" name="nbre_places" placeholder="9" value="{{ old('nbre_places') }}">
                                <span class="text-danger error-text fs-7">@error('nbre_places') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="date_naissance_c">Nombre de places</label>
                            </div>
                        </div>

                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('usage') is-invalid @enderror" id="usage" name="usage" aria-label="Floating label select example" value="{{ old('usage') }}">
                                    <option value="0" selected>Choisissez une option</option>
                                    @foreach ($usages as $usage)
                                        <option value="{{ $usage->id }}" {{ (old('type_moteur') == $usage->id ? "selected":"") }}>{{ $usage->libelle_u }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text">@error('usage') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="usage">Usage du véhicule</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('date_acquisition') is-invalid @enderror" id="date_acquisition" name="date_acquisition" value="{{ old('date_acquisition') }}">
                                <span class="text-danger error-text">@error('date_acquisition') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="delivrance_p">Date d'acquisition</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('prix_acquisition') is-invalid @enderror" id="prix_acquisition" name="prix_acquisition" placeholder="100000" value="{{ old('prix_acquisition') }}">
                                <span class="text-danger error-text fs-7">@error('prix_acquisition') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="prix_acquisition">Prix d'acquisition</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('consommation_de_base') is-invalid @enderror" id="consommation_de_base" placeholder="20" name="consommation_de_base" value="{{ old('consommation_de_base') }}">
                                <span class="text-danger error-text">@error('consommation_de_base') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="consommation_de_base">Consommation de base (en l/100 km)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('recette_hebdo_attendue') is-invalid @enderror" id="recette_hebdo_attendue" placeholder="20" name="recette_hebdo_attendue" value="{{ old('recette_hebdo_attendue') }}">
                                <span class="text-danger error-text">@error('recette_hebdo_attendue') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="recette_hebdo_attendue">Recette hebdomadaire attendue</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-3">
                        <button type="submit" class="btn btn-success js-click-ripple rounded-0" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 92px; width: 92px; top: -24.0001px; left: -14.2626px;"></span>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>

    <!-- END Page Content -->
@endsection
