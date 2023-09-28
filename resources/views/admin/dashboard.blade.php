@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-muted">Total Orders </h6>
                                            <h3>{{$countOrders}}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-basket-loaded success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-muted">Total Users</h6>
                                            <h3>3,568</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-users danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-muted">Total Revenue</h6>
                                            <h3>3,568</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-graph success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-muted">Total Rating</h6>
                                            <h3>3,568</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-star warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="row">
                    <div id="recent-transactions" class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Transactions</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"
                                               href="invoice-summary.html" target="_blank">Invoice Summary</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Invoice#</th>
                                            <th class="border-top-0">Customer Name</th>
                                            <th class="border-top-0">Products</th>
                                            <th class="border-top-0">Shipping</th>
                                            <th class="border-top-0">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                @if($order->status == 'ordered')
                                                    <td class="text-truncate">
                                                        <i class="la la-dot-circle-o warning font-medium-1 mr-1"></i>
                                                        Pending
                                                    </td>
                                                @elseif($order->status == 'canceled')
                                                    <td class="text-truncate"><i class="la la-dot-circle-o danger font-medium-1 mr-1"></i>
                                                        Declined
                                                    </td>
                                                @else
                                                    <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>
                                                        {{$order->status}}</td>
                                                @endif
                                                    <td class="text-truncate"><a href="{{route('order.details', $order->id)}}">INV-{{$order->id}}</a></td>
                                                <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-4.png"
                                 alt="avatar">
                          </span>
                                                    <span>{{$order->firstname}} {{$order->lastname}}</span>
                                                </td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        @foreach($order->orderItems as $item)
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{$item->meal->name}}"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius"
                                                                 src="{{$item->meal->image}}"
                                                                 style="width: 30px; height: 40px"
                                                                 alt="Avatar">
                                                        </li>
                                                        @endforeach
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+1 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 25%"
                                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td class="text-truncate">$ {{$order->subtotal}}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Recent Transactions -->

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Orders</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="new-orders" class="media-list position-relative">
                                    <div class="table-responsive">
                                        <table id="new-orders-table" class="table table-hover table-xl mb-0">
                                            <thead>
                                            <tr>
                                                <th class="border-top-0">Product</th>
                                                <th class="border-top-0">Customers</th>
                                                <th class="border-top-0">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-truncate">iPhone X</td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-19.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-18.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-17.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+4 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">$8999</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">Pixel 2</td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Scott"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-16.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Charles Miller"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-15.png"
                                                                 alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">$5550</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">OnePlus</td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Christine Ramos"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Thomas Brewer"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Chapman"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-9.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+3 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">$9000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">Galaxy</td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Ryan Schneider"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-14.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Tiffany Oliver"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-13.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joan Reid"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-12.png"
                                                                 alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">$7500</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">Moto Z2</td>
                                                <td class="text-truncate p-1">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png"
                                                                 alt="Avatar">
                                                        </li>
                                                        <li class="avatar avatar-sm">
                                                            <span class="badge badge-info">+1 more</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate">$8500</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

