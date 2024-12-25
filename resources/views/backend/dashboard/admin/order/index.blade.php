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
    </style>
@endsection
@section('admin-content')
<section class="py-1">
    <div class="row">
        @include('backend.layouts.partials.messages')
        <div class="col-12">
            <div class="card mb-4">
                {{-- <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Order List</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">

                        </div>
                    </div>
                </div> --}}
                <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-bordered table-striped align-items-center mb-0" id="users_table">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Number</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type of Video</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number of Video</th>
                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration of Time</th> --}}
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
                                <span class="badge badge-sm bg-primary text-xs font-weight-bold">{{ $item->order_number }}</span>
                             </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs text-center font-weight-bold mb-0">{{ $item->user->name ?? '' }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-xs text-center font-weight-bold mb-0">{{ $item->user_email ?? '' }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                @if ($item->video_type == 'basic')
                                     <p class="badge badge-sm bg-primary text-xs text-center font-weight-bold mb-0">{{ ucfirst($item->video_type ?? '') }}</p>
                                @elseif ($item->video_type == 'pro-animation')
                                     <p class="badge badge-sm bg-success text-xs text-center font-weight-bold mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                @elseif ($item->video_type == 'youtube')
                                     <p class="badge badge-sm bg-info text-xs text-center font-weight-bold mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                @else
                                     <p class="badge badge-sm bg-warning text-xs text-center font-weight-bold mb-0">{{ ucfirst($item->video_type) ?? '' }}</p>
                                @endif
                             </td>
                             <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-info">{{ $item->number_of_videos }}</span>
                            </td>
                            {{-- <td class="align-middle text-center text-sm">
                                @if ($item->first_video_duration)
                                     <span class="text-xs badge badge-sm bg-info">{{ $item->first_video_duration }} minutes</span>
                                @endif
                                @if ($item->second_video_duration)
                                     <span class="text-xs badge badge-sm bg-info">{{ $item->second_video_duration }} minutes</span>
                                @endif
                                @if ($item->third_video_duration)
                                     <span class="text-xs badge badge-sm bg-info">{{ $item->third_video_duration }} minutes</span>
                                @endif
                             </td> --}}
                             <td class="align-middle text-center text-sm">
                                <span class="text-xs badge badge-sm bg-success font-weight-bold">{{ $item->fast_delivery_charge ?? ''}}</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs text-secondary text-xs font-weight-bold">{{ $item->subtotal ?? ''}}</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">{{ $item->total ?? ''}}</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                                @if ($item->order_status == 'accepted')
                                     <span class="badge badge-sm bg-info text-xs font-weight-bold">{{ $item->order_status }}</span>
                                @elseif ($item->order_status == 'pending')
                                     <span class="badge badge-sm bg-warning text-xs font-weight-bold">Pending</span>
                                @elseif ($item->order_status == 'delivered')
                                     <span class="badge badge-sm bg-info text-xs font-weight-bold">Delivered</span>
                                @elseif ($item->order_status == 'init')
                                     <span class="badge badge-sm bg-primary text-xs font-weight-bold">Init</span>
                                @else
                                     <span class="badge badge-sm bg-danger text-xs font-weight-bold">Canceled</span>
                                @endif
                             </td>
                             <td class="align-middle text-center text-sm">
                                @if ($item->payment_status == 'accepted')
                                     <span class="badge badge-sm bg-primary text-xs font-weight-bold">Accepted</span>
                                @elseif ($item->payment_status == 'pending')
                                     <span class="badge badge-sm bg-warning text-secondary text-xs font-weight-bold">Pending</span>
                                @else
                                     <span class="badge badge-sm bg-danger text-secondary text-xs font-weight-bold">Rejected</span>
                                @endif
                             </td>
                            </td>
                            <td class="align-middle text-center">
                                <a class="btn waves-effect waves-light btn-info btn-sm-custom ml-1 mb-0" title="View Order Details" href="{{ route('order.show', $item->id) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if($item->order_status == 'accepted' && $item->payment_status == 'accepted')
                                    <button class="btn waves-effect waves-light btn-primary btn-sm-custom ml-1 mb-0 text-white deliverItem" title="Deliver order" data-id="{{$item->id}}">
                                        <i class="fa fa-truck"></i>
                                    </button>
                                    <form id="deliveryForm{{$item->id}}" action="{{route('order.delivery', [$item->id])}}" method="post" style="display:none">
                                        @csrf
                                        @method('post')
                                        <input type="text" name="delivery_link">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                                class="icofont icofont-check"></i> Confirm order delivery</button>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Cancel</button>
                                    </form>
                                    <button class="btn waves-effect waves-light btn-danger btn-sm-custom ml-1 mb-0 text-white deleteItem" title="Refund and delete" data-id="{{$item->id}}">
                                        <i class="fa fa-rotate-left"></i>
                                    </button>
                                    <form id="refundForm{{$item->id}}" action="{{route('order.destroy', [$item->id])}}" method="post" style="display:none">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                                class="icofont icofont-check"></i> Confirm refund and cancel order</button>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Cancel</button>
                                    </form>
                                @endif
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
</section>
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
