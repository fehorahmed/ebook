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
                               <h3>Footer Title</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                          
                      <form method="post" action="{{ route('footer_u') }}">
                        @csrf
                          <div class="form-group">
                             
                              <input type="text" name="one" class="form-control" value="{{ $db ? $db->one : '' }}">
                          </div>
                           <div class="form-group">
                             
                              <input type="text" name="two" class="form-control" value="{{ $db ? $db->two : '' }}">
                          </div>
                           <div class="form-group">
                              
                              <input type="text" name="three" class="form-control" value="{{ $db ? $db->three : '' }}">
                          </div>
                          <div class="form-group">
                              
                              <input type="text" name="four" class="form-control" value="{{ $db ? $db->four : '' }}">
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