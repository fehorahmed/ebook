@extends('backend.layouts.backend_master')
@section('title', 'User Details')
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
        #users_table_filter{
            text-align: right;
        }
    </style>
@endsection
@section('admin-content')
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{asset('backend/assets/img/curved-images/curved0.jpg')}}'); background-position-y: 50%;">
        <span class="mask bg-gradient-info opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ $user->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
  <div class="row py-3">
    @include('frontend.user-dashboard.partials.messages')
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Customer Order List</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-flush dataTable-table" id="users_table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type of Video</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number of Video</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration of Time</th>
                                <th width="20%" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">First Delivery Charge</th>
                                <th width="20%" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sub Total</th>
                                <th width="20%" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Status</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                              <td class="align-middle text-center text-sm"><p class="text-xs text-center font-weight-medium mb-0">{{ $loop->iteration }}</p></td>
                              <td class="align-middle text-center text-sm">
                                 @if ($item->video_type == 'basic')
                                      <p class="text-xs badge badge-sm bg-primary text-center font-weight-bold mb-0">{{ ucfirst($item->video_type ?? '') }}</p>
                                 @elseif ($item->video_type == 'pro-animation')
                                      <p class="text-xs badge badge-sm bg-success text-center font-weight-blod mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                 @elseif ($item->video_type == 'youtube')
                                      <p class="text-xs badge badge-sm bg-info text-center font-weight-bold mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                 @else
                                      <p class="text-xs badge badge-sm bg-warning text-center font-weight-bold mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                 @endif
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span class="badge badge-sm bg-info font-weight-bold text-xs">{{ $item->number_of_videos }}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                 @if ($item->first_video_duration)
                                      <span class="badge badge-sm bg-info font-weight-bold text-xs">{{ $item->first_video_duration }} minutes</span>
                                 @endif
                                 @if ($item->second_video_duration)
                                      <span class="badge badge-sm bg-info font-weight-bold text-xs">{{ $item->second_video_duration }} minutes</span>
                                 @endif
                                 @if ($item->third_video_duration)
                                      <span class="badge badge-sm bg-info font-weight-bold text-xs">{{ $item->third_video_duration }} minutes</span>
                                 @endif
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span class="badge badge-sm bg-success text-xs">{{ $item->fast_delivery_charge ?? ''}}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bold">{{ $item->subtotal ?? ''}}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                  <span class="text-secondary text-xs font-weight-bold">{{ $item->total ?? ''}}</span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                 @if ($item->order_status == 'accepted')
                                      <span class="text-xs badge badge-sm bg-info">{{ $item->order_status }}</span>
                                 @elseif ($item->order_status == 'pending')
                                      <span class="text-xs badge badge-sm bg-warning text-xs font-weight-bold">Pending</span>    
                                 @elseif ($item->order_status == 'delivered')
                                      <span class="text-xs badge badge-sm bg-primary text-xs font-weight-bold">Delivered</span>    
                                 @elseif ($item->order_status == 'init')
                                      <span class="text-xs badge badge-sm bg-info text-xs font-weight-bold">Init</span>    
                                 @else
                                      <span class="text-xs badge badge-sm bg-danger text-xs font-weight-bold">Canceled</span>
                                 @endif
                              </td>   
                              <td class="align-middle text-center text-sm">
                                 @if ($item->payment_status == 'accepted')
                                      <span class="badge badge-sm bg-primary text-xs font-weight-bold">Accepted</span>
                                 @elseif ($item->payment_status == 'pending')
                                      <span class="badge badge-sm bg-warning text-xs font-weight-bold">Pending</span>   
                                 @else
                                      <span class="badge badge-sm bg-danger text-secondary text-xs font-weight-bold">Rejected</span>
                                 @endif
                              </td>
                              <td>
                                  <a class="btn waves-effect waves-light btn-info btn-sm-custom ml-1 mb-0" title="View Order Details" href="{{ route('order.show', $item->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                              </td>
                          </tr>
                            @endforeach  
                        </tbody>
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
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // update password
        $('#updateBtn').click(function (e) {
            e.preventDefault();
            let formData = {
                old_password: $('#passwordForm input[name="old_password"').val(),
                password: $('#passwordForm input[name="password"').val(),
                password_confirmation: $('#passwordForm input[name="password_confirmation"').val(),
            };
           
            $.ajax({
                data: formData,
                type: "POST",
                url: "{{ route('password_update') }}",
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(response.success){
                       toastr.success(response.message); 
                    }else{
                        toastr.error(response.message); 
                    }
                    
                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function(index, value){
                        toastr.error(value);
                    })
                }
            });
        });
        
    });
</script>
@endsection
