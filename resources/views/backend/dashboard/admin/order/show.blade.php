@extends('backend.layouts.backend_master')
@section('title')
    {{-- @include('backend.admin.users.partials.title') --}}
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
        #users_table_filter{
            text-align: right;
        }
        .ms-auto {
            margin-left: 0px !important;
        }
        .btn_cass{
            margin-left: 367px;
        }
    </style>
@endsection
@section('admin-content')
<div class="row py-3">
    <div class="col-lg-10 mx-auto">
        <div class="card mb-4">
            <div class="card-header p-3 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Order Details</h6>
                        <p class="text-sm mb-0">
                            Order no. <b class="text-info">{{ $order->order_number }}</b>
                        </p>
                    </div>
                    <div class="">
                        @if($order->order_status == 'accepted' && $order->payment_status == 'accepted')
                            {{-- <button type="button" class="btn waves-effect waves-light btn-primary btn-sm-custom ml-1 mb-0 text-white deliverItem" title="Deliver order" data-id="{{$order->id}}">
                                <i class="fa fa-truck"></i>
                            </button> --}}
                            <button type="button" class="btn btn-primary btn-sm mt-1 ml-1 mb-0 text-white deliverItem" title="Deliver order" data-id="{{$order->id}}">
                                <i class="fa fa-truck"></i>
                            </button>
                            <form id="deliveryForm{{$order->id}}" action="{{route('order.delivery', [$order->id])}}" method="post" style="display:none">
                                @csrf
                                @method('post')
                                <input type="text" name="delivery_link">
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                        class="icofont icofont-check"></i> Confirm order delivery</button>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </form>
                            <button class="btn btn-danger btn-sm mt-1 ml-1 mb-0 text-white deleteItem" title="Refund and delete" data-id="{{$order->id}}">
                                <i class="fa fa-rotate-left"></i>
                            </button>
                            <form id="refundForm{{$order->id}}" action="{{route('order.destroy', [$order->id])}}" method="post" style="display:none">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                        class="icofont icofont-check"></i> Confirm refund and cancel order</button>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </form>
                        @endif
                   </div>
                    <a href="{{ route('order.index') }}" class="btn btn-info text-white ms-auto mb-0">Back To Order List</a>
                </div>
            </div>
            <div class="card-body p-3 pt-0">
                <hr class="horizontal dark mt-0 mb-4">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="d-flex">
                            <div>
                                @if ($order->video_type == 'basic')
                                <h6 class="badge badge-sm text-xs bg-primary text-lg mb-2 mt-2">{{ ucfirst($order->video_type) }} video </h6>
                                @elseif ($order->video_type == 'pro-animation')
                                    <h6 class="badge badge-sm text-xs bg-success text-lg mb-2 mt-2">{{ ucfirst($order->video_type) }} video </h6>  
                                @elseif ($order->video_type == 'youtube')  
                                    <h6 class="badge badge-sm text-xs bg-info text-lg mb-2 mt-2">{{ ucfirst($order->video_type) }} video </h6>
                                @else  
                                    <h6 class="badge badge-sm text-xs bg-warning text-lg mb-2 mt-2">{{ ucfirst($order->video_type) }} video </h6>
                                @endif
                                
                                <p class="text-sm mb-1"><b>Number of videos : </b><span class="badge badge-sm bg-info">{{ $order->number_of_videos }}</span></p>
                                <p class="text-sm mb-1"><b>Duration of videos : </b>
                                    @if($order->first_video_duration)
                                        <span class="badge badge-sm bg-info">{{ $order->first_video_duration }} minutes</span>
                                    @endif
                                    @if($order->second_video_duration)
                                        <span class="badge badge-sm bg-info">{{ $order->second_video_duration }} minutes</span>
                                    @endif
                                    @if($order->third_video_duration)
                                        <span class="badge badge-sm bg-info">{{ $order->third_video_duration }} minutes</span>
                                    @endif
                                </p>
                                <p class="text-sm mb-1"><b>No data : </b>
                                    @if($order->no_data == 1)
                                        <span class="badge badge-sm bg-gradient-success">Yes</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">No</span>
                                    @endif
                                </p>
                                <p class="text-sm mb-1"><b> Fast delivery : </b>
                                    @if($order->fast_delivery == 1)
                                        <span class="badge badge-sm bg-gradient-success">Yes</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">No</span>
                                    @endif
                                </p>
                                <p class="text-sm mb-1"><b> Order status : </b>
                                    <span class="badge badge-sm bg-info">{{ $order->order_status }}</span>
                                </p>
                                <p class="text-sm mb-1"><b> Payment status : </b>
                                    <span class="badge badge-sm bg-primary">{{ $order->payment_status }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <h6 class="text-lg mb-0 mt-2">Requirements</h6>
                        <p class="text-sm mb-1">{{ $order->requirements }}</p>
                        <h6 class="text-lg mb-0 mt-3">Raw data link</h6>
                        <p class="text-sm mb-1">{{ $order->raw_data_link }}</p>
                        @if($order->delivery_link)
                        <h6 class="text-lg mb-0 mt-3 text-info">Delivery link</h6>
                        <p class="text-sm mb-1">{{ $order->delivery_link }}</p>
                        @endif
                    </div>
                </div>
                <hr class="horizontal dark mt-4 mb-4">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <h6 class="mb-3">Track order</h6>
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-bell-55 text-primary"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order created</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                        {{ $order->order_init_at->format('d M g:i A') }}</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-credit-card text-info"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Payment added</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                        {{ $order->order_accepted_at->format('d M g:i A') }}</p>
                                </div>
                            </div>
                            @if ($order->order_status == 'canceled')
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="fa fa-trash text-danger"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Order cancelled</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                            {{ $order->order_canceled_at ? $order->order_canceled_at->format('d M g:i A') : '' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if ($order->order_status == 'delivered')
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-check-bold text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">Order delivered</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                            {{ $order->order_delivered_at ? $order->order_delivered_at->format('d M g:i A') : '' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <h6 class="mb-3">Customer details</h6>
                        @if($order->order_details)
                            <div class="card card-body border card-plain border-radius-lg">
                                <p class="mb-1 text-sm"><b>Customer Name: </b>{{ $order->user->name ?? ''}}</p>    
                                <p class="mb-1 text-sm"><b>Customer Email: </b>{{ $order->user_email }}</p>    
                            </div>
                        @endif
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <h6 class="mb-3">Payment details</h6>
                        @if($order->order_details)
                            <div class="card card-body border card-plain border-radius-lg">
                                <p class="mb-1 text-sm"><b>Cardholder name: </b>{{ $order->order_details->card_holder_name }}</p>    
                                <p class="mb-1 text-sm"><b>Card number: </b>****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;{{ $order->order_details->card_number }}</p>    
                                <p class="mb-1 text-sm"><b>Card expiray date: </b>{{ $order->order_details->card_expiry_month }} / {{ $order->order_details->card_expiry_year }}</p>
                            </div>
                        @endif
                    </div> --}}
                    <div class="col-lg-4 col-12 ms-auto">
                        <h6 class="mb-3">Order Summary</h6>
                        <div class="d-flex justify-content-between">
                            <span class="mb-2 text-sm">
                                Subtotal
                            </span>
                            <span class="text-dark font-weight-bold ms-2">${{ $order->subtotal }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mb-2 text-sm">
                                Fast Delivery:
                            </span>
                            <span class="text-dark ms-2 font-weight-bold">${{ $order->fast_delivery_charge }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <span class="mb-2 text-lg">
                                Total:
                            </span>
                            <span class="text-dark text-lg ms-2 font-weight-bold">${{ $order->total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="row py-3">
    <div class="col-lg-10 mx-auto">
        <div class="card mb-4">
        <div class="card-header p-3 pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Order Details</h6>
                    <p class="text-sm mb-0">
                    Order no. <b>241342</b> from <b>23.02.2021</b>
                    </p>
                    <p class="text-sm">
                    Code: <b>KF332</b>
                    </p>
                </div>
                <a href="javascript:;" class="btn bg-gradient-secondary ms-auto mb-0">Invoice</a>
            </div>
        </div>
     <div class="card-body p-3 pt-0">
            <hr class="horizontal dark mt-0 mb-4">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
        <div class="d-flex">
            <div>
                <img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1400&amp;q=80" class="avatar avatar-xxl me-3" alt="product image">
            </div>
                <div>
                    <h6 class="text-lg mb-0 mt-2">Gold Glasses</h6>
                    <p class="text-sm mb-3">Order was delivered 2 days ago.</p>
                    <span class="badge badge-sm bg-gradient-success">Delivered</span>
                </div>
        </div>
        </div>
            <div class="col-lg-6 col-md-6 col-12 my-auto text-end">
                <a href="javascript:;" class="btn bg-gradient-info mb-0">Contact Us</a>
                <p class="text-sm mt-2 mb-0">Do you like the product? Leave us a review <a href="javascript:;">here</a>.</p>
            </div>
        </div>
        <hr class="horizontal dark mt-4 mb-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <h6 class="mb-3">Track order</h6>
            <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
                <span class="timeline-step">
                    <i class="ni ni-bell-55 text-secondary"></i>
                </span>
                <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order received</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 AM</p>
                </div>
            </div>
            <div class="timeline-block mb-3">
                    <span class="timeline-step">
                        <i class="ni ni-html5 text-secondary"></i>
                    </span>
                <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Generate order id #1832412</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:21 AM</p>
                </div>
            </div>
            <div class="timeline-block mb-3">
                <span class="timeline-step">
                    <i class="ni ni-cart text-secondary"></i>
                </span>
            <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Order transmited to courier</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 8:10 AM</p>
            </div>
            </div>
            <div class="timeline-block mb-3">
                    <span class="timeline-step">
                        <i class="ni ni-check-bold text-success text-gradient"></i>
                    </span>
                <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order delivered</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 4:54 PM</p>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-12">
                <h6 class="mb-3">Payment details</h6>
            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                <img class="w-10 me-3 mb-0" src="../../../assets/img/logos/mastercard.png" alt="logo">
                <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="We do not store card details">
                <i class="fas fa-info" aria-hidden="true"></i>
                </button>
            </div>
            <h6 class="mb-3 mt-4">Billing Information</h6>
            <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <h6 class="mb-3 text-sm">Oliver Liam</h6>
                            <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-2">Viking Burrito</span></span>
                            <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">oliver@burrito.com</span></span>
                            <span class="text-xs">VAT Number: <span class="text-dark ms-2 font-weight-bold">FRB1235476</span>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-lg-3 col-12 ms-auto">
            <h6 class="mb-3">Order Summary</h6>
            <div class="d-flex justify-content-between">
                <span class="mb-2 text-sm">
                Product Price:
                </span>
                <span class="text-dark font-weight-bold ms-2">$90</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="mb-2 text-sm">
                Delivery:
                </span>
                <span class="text-dark ms-2 font-weight-bold">$14</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-sm">
                Taxes:
                </span>
                <span class="text-dark ms-2 font-weight-bold">$1.95</span>
            </div>
                <div class="d-flex justify-content-between mt-4">
                    <span class="mb-2 text-lg">
                    Total:
                    </span>
                    <span class="text-dark text-lg ms-2 font-weight-bold">$105.95</span>
                </div>
             </div>
           </div>
         </div>
      </div>
    </div>
</div> --}}


@endsection
    
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();

        $('#users_table').DataTable({
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    'bSortable': false,
                    'bSearchable': false,
                    "className": "text-center",
                    'aTargets': [-1]
                }
            ]
        });

        $('.deliverItem').on('click',function(){
            let id = $(this).data('id')
            Swal.fire({
                title: "Submit your Delivery link",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Deliver it!",
                showLoaderOnConfirm: true,
                preConfirm: (inputValue) => {
                    if (!inputValue) {
                        Swal.showValidationMessage('Please enter something');
                    }
                    return inputValue;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
            .then((result) => {
                if (result.isConfirmed) {
                    const inputValue = result.value;
                    $('[name="delivery_link"]').val(inputValue);
                    $("#deliveryForm"+id).submit();
                }
            });
        });
        $('.deleteItem').on('click',function(){
            let id = $(this).data('id')
            swal.fire({ 
                title: "Do you want to refund and cancel order?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, refund and cancel it!"
            }).then((result) => {
                if (result.value) {
                    $("#refundForm"+id).submit();
                }
            })
        });
    });
</script>
@endsection
