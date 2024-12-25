@extends('backend.layouts.master')
@section('title')
    {{-- @include('backend.dashboard.admin.steps.partials.title') --}}
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
    {{-- @include('backend.dashboard.admin.steps.partials.header-breadcrumbs') --}}
    <div class="page-body">
        <div class="row">
            @include('backend.layouts.partials.messages')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                               <h3>Social link</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <form method="post" action="{{ route('social2') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ $db ? $db->facebook : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $db ? $db->instagram : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>LinkedIn</label>
                                    <input type="text" name="youtube" class="form-control" value="{{ $db ? $db->youtube : '' }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection