@extends('backend.layouts.master')
@section('title')
    articles
@endsection
@section('styles')
    <style>
        .btn-sm-custom{
            padding: 5px 5px;
            line-height: 16px;
            font-size: 16px;
        }
        .btn-sm-custom i {
            margin-right: 0px !important;
        }
        .social-widget-card-custom{
            cursor: pointer;
        }
    </style>
@endsection
@section('admin-content')
    <div class="page-body">
        <div class="row">
            @include('backend.layouts.partials.messages')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h3>Articles</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('articles.create') }}" class="btn btn-info"> <i class="icofont icofont-plus-circle"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap" id="articles_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>keywords</th>
                                        <th>views</th>
                                        <th>image</th>
                                        <th width="100">Action</th>
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
        $('table#articles_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('articles.index') }}"},
            aLengthMenu: [[10, 20, 50, 100, 1000, -1], [10, 20, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'keywords', name: 'keywords'},
                {data: 'views', name: 'views'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action'}
            ]
        });
    });
</script>
@endsection
