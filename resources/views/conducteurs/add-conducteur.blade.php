@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Ajouter un nouveau conducteur
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Ajouter conducteur
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
                    Informations du conducteur
                </h3>
            </div>
            <div class="block-content">
                <form action="{{ route('save.conducteur') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nom_c') is-invalid @enderror" id="nom_c" name="nom_c" placeholder="Doe" value="{{ old('nom_c') }}">
                                <span class="text-danger error-text fs-7">@error('nom_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="nom_c">Nom</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('prenom_c') is-invalid @enderror" id="prenom_c" name="prenom_c" placeholder="John" value="{{ old('prenom_c') }}">
                                <span class="text-danger error-text fs-7">@error('prenom_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="prenom_c">Prénom</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="js-flatpickr form-control @error('date_naissance_c') is-invalid @enderror" id="date_naissance_c" name="date_naissance_c" placeholder="jj-mm-aaaa" value="{{ old('date_naissance_c') }}">
                                <span class="text-danger error-text fs-7">@error('date_naissance_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="date_naissance_c">Date de naissance</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="js-masked-phone-tg form-control @error('telephone_c') is-invalid @enderror" id="telephone_c" name="telephone_c" placeholder="+228 99 99 99 99" value="{{ old('telephone_c') }}">
                                <span class="text-danger error-text fs-7">@error('telephone_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="telephone_c">Téléphone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email_c') is-invalid @enderror" id="email_c" name="email_c" placeholder="john.doe@example.com" value="{{ old('email_c') }}">
                                <span class="text-danger error-text fs-7">@error('email_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="email_c">Email</label>
                            </div>
                        </div>

                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('adresse_c') is-invalid @enderror" id="adresse_c" name="adresse_c" placeholder="Adidoadin, Lomé, TOGO" value="{{ old('adresse_c') }}">
                                <span class="text-danger error-text fs-7">@error('adresse_c') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="adresse_c">Adresse</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select @error('type_permis') is-invalid @enderror" id="type_permis" name="type_permis" aria-label="Floating label select example" value="{{ old('type_permis') }}">
                                    <option value="0" selected>Choisissez une option</option>
                                    @foreach ($types_permis as $type_permis)
                                        <option value="{{ $type_permis }}">{{ $type_permis }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text">@error('type_permis') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="type_permis">Type de permis</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('delivrance_p') is-invalid @enderror" id="delivrance_p" name="delivrance_p" value="{{ old('delivrance_p') }}">
                                <span class="text-danger error-text">@error('delivrance_p') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="delivrance_p">Date de délivrance du permis</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('expiration_p') is-invalid @enderror" id="expiration_p" name="expiration_p" value="{{ old('expiration_p') }}">
                                <span class="text-danger error-text">@error('expiration_p') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                <label for="expiration_p">Date d'expiration du permis</label>
                            </div>
                            <div class="form-floating mb-3 overflow-hidden">
                                <div class="mb-2">
                                    <label class="form-label" for="scan_permis">Scan du permis de conduire</label>
                                    <input class="form-control @error('scan_permis') is-invalid @enderror" type="file" id="scan_permis" name="scan_permis" value="{{ old('scan_permis') }}">
                                    <span class="text-danger error-text">@error('scan_permis') <p style="font-size:14px">{{ $message }}</p> @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-3">
                        <button type="submit" class="btn btn-success js-click-ripple-enabled rounded-0" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 92px; width: 92px; top: -24.0001px; left: -14.2626px;"></span>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>

    {{-- <script src="assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script> --}}
    <!-- END Page Content -->
@endsection
