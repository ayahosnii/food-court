<div>
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                @livewire('all-courts')
                <div class="col-lg-9">
                    @livewire('header-search-component')
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    @livewire('hero-section', ['title' => 'Checkout', 'pageName' => 'Checkout'])
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form wire:submit.prevent="placeOrder" onsubmit="$('#processing').show();">
                    <div class="row">
                        @include('livewire.checkout.partials.form1')
                        @include('livewire.checkout.partials.billing-details')
                        @if($ship_to_different)
                            @include('livewire.checkout.partials.form2')
                        @endif
                    </div>
                    <button type="submit" style="background: #55724f;" class="site-btn">PLACE ORDER</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

</div>
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        console.log('work')
        cardElement.mount('#card-element');
        var cardholderName = document.getElementById('cardholder-name');
        var submitButton = document.getElementById('submit-button');
        submitButton.addEventListener('click', function(ev) {
            ev.preventDefault();
            stripe.confirmCardPayment('{{ $paymentIntentId }}', {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardholderName.value
                    }
                }
            }).then(function(result) {
                if (result.error) {
                    console.error(result.error);
                    alert('Payment failed');
                } else {
                    Livewire.emit('orderPlaced');
                }
            });
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOnrM9ISkivX_c_h82WzlOx-REJHnQLKQ&callback=initMap"async defer></script>
    <script>


        function showMap(event) {
            event.preventDefault(); // prevent page refresh
            document.getElementById("map").style.display = "block";

            // Retrieve the user's address and province from input fields
            var address = document.getElementById('address').value;
            var province = document.getElementById('province').value;

            console.log(address);
            console.log(province);

            // Send a geocoding request to Nominatim API
            var url =
                "https://nominatim.openstreetmap.org/search?format=json&limit=1&q=" +
                encodeURIComponent(address + ", " + province) +
                "&accept-language=ar";
            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        // Parse the response to get the latitude and longitude coordinates
                        var latitude = parseFloat(data[0].lat);
                        var longitude = parseFloat(data[0].lon);



                        // Display the map
                        var map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: latitude, lng: longitude },
                            zoom: 18,
                            myLocationButton: true
                        });
                        // Add a marker to the map
                        var marker = new google.maps.Marker({
                            position: { lat: latitude, lng: longitude },
                            map: map,
                            draggable: true, // make the marker draggable
                        });

                        map.addListener("click", function(event) {
                            marker.setPosition(event.latLng);
                        });

                        // Update the latitude and longitude inputs with the initial coordinates
                        var latitudeSpan = document.getElementById("lati");
                        latitudeSpan.textContent = latitude;

                        var longitudeSpan = document.getElementById("longi");
                        longitudeSpan.textContent = longitude;



                        // Reverse geocode the coordinates to get the address
                        var geocodeUrl = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + latitude + "&lon=" + longitude + "&accept-language=ar"; // Set the language to Arabic

                        fetch(geocodeUrl)
                            .then(response => response.json())
                            .then(data => {
                                var display_name = data.display_name;
                                var addressElement = document.getElementById("address-display");
                                addressElement.innerText = display_name;
                            })


                            .catch(error => {
                                console.error("Error:", error);
                                alert("Geocode was not successful for the following reason: " + error.message);
                            });

                        var addAddressBtn = document.getElementById("add-address-btn");
                        addAddressBtn.addEventListener("click", function() {
                            var addressResult = document.getElementById("address-display").innerText;
                            var addressInput = document.getElementById("address");
                            addressInput.value = addressResult;
                        });


                        // Add an event listener to the marker to update the displayed address when moved
                        marker.addListener("dragend", function(event) {
                            var location = marker.getPosition();
                            var geocodeUrl = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + location.lat() + "&lon=" + location.lng() + "&accept-language=ar"; // Set the language to Arabic
                            fetch(geocodeUrl)
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data)
                                    var display_name = data.display_name;
                                    var addressElement = document.getElementById("address-display");
                                    addressElement.innerText = display_name;
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                    alert("Geocode was not successful for the following reason: " + error.message);
                                });
                        });
                    } else {
                        // Handle error response
                        alert("Geocode was not successful for the following reason: no result found");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Geocode was not successful for the following reason: " + error.message);
                });
        }
    </script>
@endpush
