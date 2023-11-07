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
                                                <div class="map">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34556.823499993675!2d31.235711536154927!3d30.044419617213937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145838f79f7eef09%3A0x7559c512954f99d6!2sCairo%2C%20Egypt!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
                                                        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                    <div class="map-inside">
                                                        <i class="icon_pin"></i>
                                                </div>
                                                <button onclick="updatePosition()">Update Position</button>
                                                <div id="map"></div>
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
@section('script')


    <script src="{{ asset('js/app.js')}}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAU7idojhoV50kILitscWS7I1WKYaAMytE&callback=initMap&v=weekly"async>
    </script>
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
            const latLng = { lat: -25.344, lng: 131};
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
@endsection
