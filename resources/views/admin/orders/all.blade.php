@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <a class="modal-effect btn btn-md btn-warning" href="{{ route('export.pending.invoice') }}" style="color:white"> <i class="fas fa-file-download"></i> &nbsp;Export Excel</a>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('admin.orders')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع لغات الموقع </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li class="breadcrumb-item active"><a href="{{route('admin.languages')}}">الرئيسية</a>
                                            </li>
                                            <li class="breadcrumb-item active"><a href="{{route('admin.languages')}}">اللغات</a>
                                            </li>
                                            <li class="breadcrumb-item "> <a href="{{route('admin.orders.pended')}}"> @lang('admin.pended')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="table-responsive">
                                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example" class="table key-buttons text-md-nowrap dataTable no-footer dtr-inline collapsed" style="text-align: center; width: 1104px;" role="grid" aria-describedby="example_info">
                                                    <thead>
                                                    <tr>
                                                        <th>First Name</th>
                                                        <th>Username</th>
                                                        <th>Address</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>نوع الكارت</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>الإجراءات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @isset($orders)
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('order.details', ['id' => $order->id]) }}">
                                                                        {{ $order->firstname }}
                                                                    </a>
                                                                </td>
                                                                <td> {{$order->user->name}}</td>
                                                                <td>{{$order->address}}</td>
                                                                <td>{{$order->total}} LE</td>
                                                                <td>{{$order->status}}</td>
                                                                <td>{{$order->latitus}}</td>
                                                                <td>{{$order->longitude}}</td>
                                                                <td>
                                                                    <div class="order-status form-control" data-id="{{$order->id}}" data-status="{{$order->status}}">
                                                                        <select>
                                                                            <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : '' }}>Pending</option>
                                                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Cancel</option>
                                                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('scripts-push')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.5/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).on('change', '.order-status select', function () {
            var $this = $(this);
            var orderStatus = $this.val();
            var orderStatusElement = $this.closest('.order-status');
            var orderId = orderStatusElement.attr('data-id');

            // Create a CSRF token meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Use the route() function to generate the URL
            var url = "{{ route('admin.orders.updateStatus', ':id') }}".replace(':id', orderId);

            // Prepare the data to be sent
            var data = {
                _token: csrfToken,
                status: orderStatus
            };

            // Send the AJAX request
            $.ajax({
                url: url,
                type: 'PUT',
                data: data,
                success: function (response) {
                    if (response.success) {
                        orderStatusElement.attr('data-status', orderStatus);
                        Swal.fire(
                            'Success!',
                            'Order status updated successfully.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to update order status.',
                            'error'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire(
                        'Error!',
                        'An error occurred while updating order status.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
