@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Enregistrer un nouveau bilan journalier
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Nouvau bilan
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

    @if (Session::get('forbidden'))
        <div class="alert alert-danger">
            {{ Session::get('forbidden')}}
        </div>
    @endif

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            {{-- <div class="block-header block-header-default">
                <h3 class="block-title">
                    Informations de l'affectation
                </h3>
            </div> --}}
            <div class="block-content">
                <form action="{{ route('info.bilanjournalier') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('vehicule') is-invalid @enderror" id="vehicule" name="vehicule" aria-label="Floating label select example" value="{{ old('vehicule') }}">
                                    <option value="0" selected>Choisissez une option</option>
                                    @foreach ($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}" {{ (old('vehicule') == $vehicule->id ? "selected":"") }}>{{ $vehicule->immatriculation }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text">@error('vehicule') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="vehicule">Véhicule concerné</label>
                            </div>
                        </div>
                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">

                                {{-- Conducteur info --}}
                                <div class="bg-secondary bg-gradient text-white p-3 mb-2">
                                    <span id="info_c" name="info_c">Conducteur</span>
                                </div>
                                <input type="hidden" id="conducteur" name="conducteur">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('date_bilan') is-invalid @enderror" id="date_bilan" name="date_bilan" value="{{ old('date_bilan') }}">
                                <span class="text-danger error-text">@error('date_bilan') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="date_bilan">Date</label>
                            </div>
                        </div>
                        <div class="col-lg-3">

                        </div>
                    </div>
                    <div class="form-group text-center m-3">
                        <button type="submit" class="btn btn-success js-click-ripple rounded-0" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 92px; width: 92px; top: -24.0001px; left: -14.2626px;"></span>Suivant <i class="fa fa-angle-right"></i></button>
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

