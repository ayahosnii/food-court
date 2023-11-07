@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> اللغات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> اللغات
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
                                            <li class="breadcrumb-item "> <a href="{{route('admin.languages.create')}}"> أضافة</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>PricePerUnit</th>
                                                <th>Unit</th>
                                                <th>Calories</th>
                                                <th>Brand</th>
                                                <th>Quantity</th>
                                                <th>Total weight</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rawMaterials as $rawMaterial)
                                                <tr>
                                                    <td>{{ $rawMaterial->name }}</td>
                                                    <td>{{ $rawMaterial->getFormattedPrice() }}</td>
                                                    <td>{{ $rawMaterial->getPricePerGram() }}</td>
                                                    <td>{{ $rawMaterial->unit }}</td>
                                                    <td>{{ $rawMaterial->calories ?? 'N/A' }}</td>
                                                    <td>{{ $rawMaterial->brand ?? 'N/A' }}</td>
                                                    <td>{{ $rawMaterial->inventory->quantity }}</td>
                                                    <td>{{ $rawMaterial->inventory->total_weight }} {{ $rawMaterial->unit }}</td>
                                                    <td>
                                                        <a href="{{-- route('raw_material.edit', $rawMaterial->id) --}}" class="btn btn-primary">Edit</a>
                                                        <form action="{{-- route('raw_material.destroy', $rawMaterial->id) --}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

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
