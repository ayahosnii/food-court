@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> @lang('admins.main-sections') </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""> @lang('admins.home') </a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('admins.products') </li>
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
                                    <h4 class="card-title"> @lang('admins.all-products') </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="example" class="table key-buttons text-md-nowrap dataTable no-footer dtr-inline collapsed" style="text-align: center; width: 1104px;" role="grid" aria-describedby="example_info">
                                                            <thead>
                                                            <tr>
                                                                <th> @lang('admins.mealname') </th>
                                                                <th> @lang('admins.mealimage') </th>
                                                                <th> @lang('admins.mealstatus') </th>
                                                                <th> @lang('admins.mealprice') </th>
                                                                <th> @lang('admins.actions') </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @isset($products)
                                                                @foreach($products as $product)
                                                                    <tr>
                                                                        <td> <a href="{{route('admin.meals.report', $product->id)}}">{{$product->name}}</a></td>
                                                                        <td><img style="width: 150px; height: 100px;" src="{{$product->image}}" alt="{{$product->name}}"></td>
                                                                        <td>{{$product -> getActive()}}</td>
                                                                        <td>${{$product->price}}</td>
                                                                        <td>
                                                                            <div class="btn-group" role="group"
                                                                                 aria-label="Basic example">
                                                                                <a href="{{route('admin.meals.edit', $product-> id)}}"
                                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> @lang('admins.edit') </a>

                                                                                <div class="btn-group" role="group"
                                                                                     aria-label="Basic example">
                                                                                    <a href="{{route('admin.meals.delete', $product-> id)}}"
                                                                                       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> @lang('admins.delete') </a>
                                                                                    <a href="{{route('admin.meals.status', $product-> id)}}"
                                                                                       class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                                        @if($product->active == 0)
                                                                                            @lang('admins.activate')
                                                                                        @else
                                                                                            @lang('admins.deactivate')
                                                                                        @endif
                                                                                    </a>
                                                                                </div>
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
                                            <div class="justify-content-center d-flex">

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
