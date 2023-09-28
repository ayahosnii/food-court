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
                                                <div id="map" style="height: 500px; display: none;" wire:ignore></div>
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


        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCu0s6B8mPSpptZ38VQWqBzljkAYj-FlR4&callback=initMap" async defer></script>

        <script>
            let map;
            let markerl;

            // Initialize and add the map
            function initMap() {
                // The location of Uluru
                const uluru = { lat: -25.344, lng: 131.036 };
                // The map, centered at Uluru
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 18,
                    center: uluru,
                });
                // The marker, positioned at Uluru
                marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                });
            }

            function updatePosition(newLat, newLng)
            {
                // alert('Its work');
                const latLng = { lat: newLat, lng: newLng};
                // alert(latLng);
                marker.setPosition(latLng);
                map.setCenter(latLng);
            }

            Echo.channel('truckerApp')
                .listen('CarMoved', (e) => {
                    // console.log(e);
                    updatePosition(e.lat, e.lng);
                });
        </script>

@endpush
