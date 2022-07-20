@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/modal.css') }}">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Actions -->
        <div class="row">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="{{ url('/editConducteur/'.$conducteur->id) }}">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Modifier conducteur
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-danger">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-danger mb-0">
                            Supprimer conducteur
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Actions -->

        <!-- User Info -->
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    {{-- <div class="mb-3">
                        <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">
                    </div> --}}
                    <p class="fs-sm fw-medium text-muted mb-3">Conducteur #{{ $conducteur->id }}</p>
                    <h1 class="fs-lg mb-0">
                        <span>{{ $conducteur->nom_c }} {{ $conducteur->prenom_c }}</span>
                    </h1>
                    <p class="fs-sm fw-medium text-muted">Permis de catégorie {{ $conducteur->type_permis }}</p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">ENGAGÉ LE</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">Date</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">ARGENT RAPPORTÉ</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">$3.580,00</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Disponibilité</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">ACTIF / INACTIF</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Affecté à</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">ID voiture</a>
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
                                <h3 class="block-title">En savoir plus</h3>
                            </div>
                            <div class="block-content">
                                {{-- <div class="fs-4 mb-1">John Parker</div> --}}
                                <address class="fs-sm">
                                    {{-- Sunrise Str 620<br>
                                    Melbourne<br>
                                    Australia, 11-587<br><br> --}}
                                    <i class="far fa-calendar-days"></i> Date de naissance : {{ $conducteur->date_naissance_c }}<br>
                                    <i class="fa fa-location-dot"></i> {{ $conducteur->adresse_c }}<br>
                                    <i class="fa fa-phone"></i> {{ $conducteur->telephone_c }} <br>
                                    <i class="fa fa-envelope"></i> <a href="javascript:void(0)">{{ $conducteur->email_c }}</a>
                                </address>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Permis de conduire</h3>
                            </div>
                            <div class="block-content">
                                <address class="fs-sm">
                                    Catégorie de permis {{ $conducteur->type_permis }}<br>
                                    Date de délivrance {{ $conducteur->delivrance_p }}<br>
                                    Date d'expiration {{ $conducteur->expiration_p}}<br>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#imgScanModal" id="showScan">
                                        Scan du permis
                                    </button>
                                    <img src="{{ url('/uploads/conducteurs/' . $conducteur->scan_permis) }}" style="display: none" alt="" id="hid">

                                    {{-- Sunrise Str 620<br>
                                    Melbourne<br>
                                    Australia, 11-587<br><br>
                                    <i class="fa fa-phone"></i> (999) 888-55555<br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a> --}}
                                </address>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>

        @include('conducteurs.display-scan-modal')
        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('js/functions/conducteurs.js') }}"></script>

        <script>
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("hid");
            var shw = document.getElementById("showScan");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            shw.onclick = function(){
                modal.style.display = "block";
                modalImg.src = img.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        </script>

        {{-- <script>
            function show() {
                /* Access image by id and change
                the display property to block*/
                document.getElementById('imgscan').style.display = "block";

                document.getElementById('showScan').style.display = "none";
            }
        </script> --}}
        <!-- END Addresses -->
    </div>
@endsection
