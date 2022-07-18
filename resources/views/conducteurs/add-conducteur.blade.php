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
                <form action="{{ route('add.conducteur') }}" method="POST">
                    <div class="row">
                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="example-text-input-floating"
                                    name="example-text-input-floating" placeholder="Doe">
                                <label for="example-text-input-floating">Nom</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="example-text-input-floating"
                                    name="example-text-input-floating" placeholder="John">
                                <label for="example-text-input-floating">Prénom</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="example-text-input-floating"
                                    name="example-text-input-floating" placeholder="+228 99 99 99 99">
                                <label for="example-text-input-floating">Téléphone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="example-email-input-floating"
                                    name="example-email-input-floating" placeholder="john.doe@example.com">
                                <label for="example-email-input-floating">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id=""
                                    name="" placeholder="Adidoadin, Lomé, TOGO">
                                <label for="example-email-input-floating">Adresse</label>
                            </div>
                        </div>

                        <div class="col-lg-6 form-box">
                            <div class="form-floating mb-4">
                                <select class="form-select" id="example-select-floating" name="example-select-floating"
                                    aria-label="Floating label select example">
                                    <option selected>Choisissez une option</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="example-select-floating">Type de permis</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="example-password-input-floating"
                                    name="example-password-input-floating" placeholder="Password">
                                <label for="example-password-input-floating">Date de délivrance du permis</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="example-password-input-floating"
                                    name="example-password-input-floating" placeholder="Password">
                                <label for="example-password-input-floating">Date d'expiration du permis</label>
                            </div>
                            <div class="form-floating mb-4 overflow-hidden">
                                <div class="mb-4">
                                    <label class="form-label" for="example-file-input">Scan du permis de conduire</label>
                                    <input class="form-control form-control-lg" type="file" id="example-file-input">
                                </div>
                                {{-- <input type="text" class="form-control" id="example-password-input-floating"
                                    name="example-password-input-floating" placeholder="Password">
                                <label for="example-password-input-floating"></label> --}}
                            </div>
                            {{-- <div class="form-floating mb-4">
                                <textarea class="form-control" id="example-textarea-floating" name="example-textarea-floating" style="height: 200px"
                                    placeholder="Leave a comment here"></textarea>
                                <label for="example-textarea-floating">Comments</label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="form-group text-center m-3">
                        <button type="button" class="btn btn-success js-click-ripple-enabled rounded-0" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 92px; width: 92px; top: -24.0001px; left: -14.2626px;"></span>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
