@extends('layouts.font2-layout')

@section('content')

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Login <li class="fa fa-user"></li></h4>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <button style="background: #366ca4" type="submit" class="site-btn my-3">
                                Login Facebook
                                <li class="fa fa-facebook mx-3" style="color: #FFFFFF"></li>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button style="background: #202326" type="submit" class="site-btn">
                                Login Google
                                <li class="fa fa-google mx-3" style="color: #FFFFFF"></li>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <label>User <i class="fa fa-user"></i></label>
                                    <input type="radio" name="userType" value="user">
                                </div>
                                <div class="col-md-6">
                                    <label>Providers <i class="fa fa-users"></i></label>
                                    <input type="radio" name="userType" value="providers">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div id="userForm" style="display: block;">
                    <h2 style="color: #55724f; font-size: 20px; padding-bottom: 10px"> User Form Content </h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" style="background: #202326" class="site-btn">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <!-- Display order summary or additional information if needed -->
                            </div>
                        </div>
                    </div>
                </form>
                </div>

                <div id="providersForm" style="display: none;">
                    <!-- Your Providers Form Content Here -->
                    <h2 style="color: #55724f; font-size: 20px; padding-bottom: 10px">
                        Providers Form Content
                    </h2>

                <form action="{{ route('login.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="provider-email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="provider-password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" style="background: #202326" class="site-btn">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <!-- Display order summary or additional information if needed -->
                            </div>
                        </div>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </section>





@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Listen for changes in the radio button selection
            $('input[name="userType"]').change(function() {
                // Get the selected value
                var selectedValue = $('input[name="userType"]:checked').val();

                // Hide both forms initially
                $('#userForm').hide();
                $('#providersForm').hide();

                // Show the corresponding form based on the selected value
                if (selectedValue === 'user') {
                    $('#userForm').show();
                } else if (selectedValue === 'providers') {
                    $('#providersForm').show();
                }
            });
        });

        $('#restaurant-logo').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Update the src attribute of the image
                    $('#selected-image').attr('src', e.target.result);
                    // Show the image element
                    $('.provider-uploaded-logo').removeClass('d-none');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endpush
