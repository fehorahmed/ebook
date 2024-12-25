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
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Order List</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-bordered table-striped align-items-center mb-0" id="users_table">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl No</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Name</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Requirement</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stripe Customer Name</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stripe Order</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2"> Order Status</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Status</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td><p class="text-xs font-weight-medium mb-0">{{ $loop->iteration }}</p></td>
                            <td class="align-middle text-center">{{ $item->user_id  ?? '' }}</td>
                            <td class="align-middle text-center">{{ $item->requirements  ?? '' }}</td>
                            <td class="align-middle text-center">{{ $item->stripe_customer_id  ?? '' }}</td>
                            <td class="align-middle text-center">{{ $item->stripe_order_id  ?? '' }}</td>
                            <td class="align-middle text-center">{{ $item->order_status  ?? '' }}</td>
                            <td class="align-middle text-center">{{ $item->payment_status  ?? '' }}</td>
                            <td class="align-middle text-center">
                                <a class="btn waves-effect waves-light btn-info btn-sm-custom ml-1 mb-0" title="View User Details" href="{{ route('order.show', $item->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
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

            $('.verifyUser').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "User will be verified!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3fc3ee",
                    confirmButtonText: "Yes, verify it!"
                }).then((result) => {
                    if (result.value) {
                        $("#verifyForm"+id).submit();
                    }
                })
            });

            $('.unverifyUser').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "User will be unverified!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3fc3ee",
                    confirmButtonText: "Yes, unverify it!"
                }).then((result) => {
                    if (result.value) {
                        $("#unverifyForm"+id).submit();
                    }
                })
            });

            $('.deleteItem').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        $("#deleteForm"+id).submit();
                    }
                })
            });
        });
    </script>
@endsection
