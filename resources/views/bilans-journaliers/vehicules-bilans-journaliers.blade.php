@extends('layouts.listing')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">

            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Bilans journaliers du  {{ date('d/m/Y', strtotime($vehiculesbilansjournaliers[0]->date_bilan)) }}
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
                            Bilans journaliers
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
                <div id="vehicules-bilansjournaliers-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>Véhicule</th>
                                <th style="width: 50%">Recette de la journée</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculesbilansjournaliers as $vbj)
                                <tr>
                                    <td><a href="#" id="showDetails" data-id="{{ $vbj->id }}">{{ $vbj->immatriculation }}</a></td>
                                    <td>{{ number_format($vbj->recette_journaliere, 2, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END Your Block -->

        @include('bilans-journaliers.modal-details-bilanjournalier')
        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('js/functions/bilansjournaliers.js') }}"></script>
    </div>
@endsection
