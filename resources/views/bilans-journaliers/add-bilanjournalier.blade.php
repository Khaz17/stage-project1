@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Bilan journalier du {{date('d/m/Y', strtotime($date))}} du véhicule {{$vehicule->immatriculation}}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Infos nouveau bilan
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



    {{$prebj}}
    {{$vehicule}}
    {{$idc}}
    {{$date}}
    {{$recette_hebdo}}

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('save.bilanjournalier') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vehicule" id="vehicule" value="{{$vehicule->id}}">
                    <input type="hidden" name="date_bilan" id="date_bilan" value="{{$date}}">
                    <input type="hidden" name="conducteur" id="conducteur" value="{{$idc}}">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('kilometrage') is-invalid @enderror" id="kilometrage" name="kilometrage" placeholder="Doe" value="{{ old('kilometrage') }}">
                        <span class="text-danger error-text fs-7">@error('kilometrage') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                        <label for="nom_c">Kilométrage</label>
                    </div>
                    @if (isset($prebj))
                        <div class="form-floating row mx-auto mb-3">

                            {{-- Kilométrage info --}}
                            <div class="bg-secondary bg-gradient text-white p-3 col-md-4">
                                <span id="label_k" name="label_k">Kilométrage au bilan précédent</span>
                            </div>
                            <div class="p-3 col-md-8 border">
                                <span id="info_k" name="info_k" style="font-size:18px">{{ $prebj->kilometrage }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('qte_essence_consommee') is-invalid @enderror" id="qte_essence_consommee" name="qte_essence_consommee" placeholder="John" value="{{ old('qte_essence_consommee') }}">
                        <span class="text-danger error-text fs-7">@error('qte_essence_consommee') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                        <label for="prenom_c">Quantité d'essence consommée</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('recette_journaliere') is-invalid @enderror" id="recette_journaliere" name="recette_journaliere" placeholder="9" value="{{ old('recette_journaliere') }}">
                        <span class="text-danger error-text fs-7">@error('recette_journaliere') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                        <label for="date_naissance_c">Recette journalière</label>
                    </div>
                    @if (isset($recette_hebdo))
                        <div class="form-floating row mx-auto mb-3">

                            {{-- Kilométrage info --}}
                            <div class="bg-secondary bg-gradient col-md-4 text-white p-3">
                                <span id="label_rh" name="label_rh">Recette de la semaine en cours</span>
                            </div>
                            <div class="border col-md-8 p-3">
                                <span id="info_rh" name="info_rh" style="font-size: 18px"> {{ number_format($recette_hebdo, 2, ',', ' ') }}  FCFA</span>
                            </div>
                        </div>
                    @endif
                    <div class="form-group text-center m-3">
                        <button type="submit" class="btn btn-success js-click-ripple rounded-0" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 92px; width: 92px; top: -24.0001px; left: -14.2626px;"></span>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>

    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/functions/bilansjournaliers.js') }}"></script>

    <!-- END Page Content -->
@endsection
