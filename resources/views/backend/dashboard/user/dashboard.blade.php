@extends('backend.layouts.master')
@section('title')
    @include('backend.dashboard.user.partials.title')
@endsection
@section('styles')
    <style>
    
    </style>
@endsection
@section('admin-content')
    @include('backend.dashboard.user.partials.header-breadcrumbs')
    <div class="page-body">
        <div class="row">
            <div class="col-md-12 col-xl-6">
                <!-- table card start -->
                <div class="card table-card">
                    <div class="">
                        <div class="row-table">
                            <div class="col-sm-6 card-block-big br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-animal-dog-alt text-success"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $totalDogs }}</h5>
                                        <span>Total Dogs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-animal-dog text-info"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $activeDams }}</h5>
                                        <span>Active Dams</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row-table">
                            <div class="col-sm-6 card-block-big br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-animal-dog-barking text-info"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $activeSires }}</h5>
                                        <span>Active Sires</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-ui-close text-danger"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $retiredDogs }}</h5>
                                        <span>Retired Dogs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table card end -->
            </div>
            <div class="col-md-12 col-xl-6">
                <!-- table card start -->
                <div class="card table-card">
                    <div class="">
                        <div class="row-table">
                            <div class="col-sm-6 card-block-big br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-paw text-success"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $totalPuppies }}</h5>
                                        <span>Total Puppies</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-ui-contact-list text-primary"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>{{ $totalContacts }}</h5>
                                        <span>Total Contacts</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row-table">
                            <div class="col-sm-6 card-block-big br">
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-cur-dollar-minus text-danger"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>$ {{ $yearlyExpenses }}</h5>
                                        <span>Yearly Expenses</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <i class="icofont icofont-cur-dollar-plus text-primary"></i>
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <h5>$ {{ $yearlyIncomes }}</h5>
                                        <span>Yearly Incomes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table card end -->
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h5>Upcoming Heats</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap" id="heats_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dog Name</th>
                                        <th>Date of Heat</th>
                                        <th>Days Since Last</th>
                                        <th>Future Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h5>Upcoming Litters</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap" id="litters_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dam</th>
                                        <th>Sire</th>
                                        <th>Date Due</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            let heatTable = $('table#heats_table').DataTable({
                language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
                processing: true,
                serverSide: true,
                ajax: {url: "{{ route('dog_upcoming_heats') }}"},
                aLengthMenu: [[5, 10, 20, 50, 100, 1000, -1], [5, 10, 20, 50, 100, 1000, "All"]],
                buttons: [],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'dog_name', name: 'dog_name'},
                    {data: 'date_heat', name: 'date_heat'},
                    {data: 'date_difference', name: 'date_difference'},
                    {data: 'next_date', name: 'next_date'}
                ]
            });

            let litterTable = $('table#litters_table').DataTable({
                language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
                processing: true,
                serverSide: true,
                ajax: {url: "{{ route('dog_upcoming_litters') }}"},
                aLengthMenu: [[5, 10, 20, 50, 100, 1000, -1], [5, 10, 20, 50, 100, 1000, "All"]],
                buttons: [],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'dam', name: 'dam'},
                    {data: 'sire', name: 'date_heat'},
                    {data: 'date_due', name: 'date_due'}
                ]
            });
        });
    </script>
@endsection
