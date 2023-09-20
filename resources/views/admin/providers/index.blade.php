@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام Home </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{--route('admin.dashboard')--}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active"> الاقسام Home
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
                                    <h4 class="card-title">جميع الموظفين </h4>
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

                                <div class="card-content collapse show" >
                                    <div class="card-body card-dashboard">
                                        <div class="content-body">
                                            <!-- Simple User Cards -->
                                            <section id="simple-user-cards" class="row">
                                                @isset($providers)
                                                    @foreach($providers as $provider)
                                                <div class="col-xl-3 col-md-6 col-12">
                                                    <div class="card" style="background-color: #f0fafb">
                                                        <div class="text-center">
                                                            <div class="card-body">
                                                                <img src="{{$provider->logo}}" class="rounded-circle  height-150"
                                                                     alt="Card image">
                                                            </div>
                                                            <div class="card-body">
                                                                <h4 class="card-title">{{$provider->name}}</h4>
                                                                <h6 class="card-subtitle text-success">{{$provider->getActive()}}</h6>

                                                            </div>
                                                            <div class="text-center">
                                                                <a href="{{route('admin.providers.report', $provider->id)}}" class="btn btn-primary">
                                                                    more
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-12 text-center">
                                                        <p>No data available.</p>
                                                    </div>
                                                @endisset
                                            </section>
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

    @stop
