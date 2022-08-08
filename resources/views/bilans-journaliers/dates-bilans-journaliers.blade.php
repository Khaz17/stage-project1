@extends('layouts.listing')

@section('content')

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">

            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Consulter les bilans journaliers
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
                <div id="dates-bilansjournaliers-table" class="p-2">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th style="width: 50%">Nombre de bilans effectués</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datesbilansjournaliers as $dbj)
                                <tr>
                                    <td><a href="{{ route('vehicules.bilansjournaliers.list', ['date' => $dbj->date_bilan]) }}">{{ date('d/m/Y', strtotime($dbj->date_bilan)) }}</a></td>
                                    <td>{{ $dbj->nbj }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END Your Block -->

        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('js/functions/bilansjournaliers.js') }}"></script>
    </div>
@endsection
