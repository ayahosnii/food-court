@extends('layouts.font2-layout')

@section('content')
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Register <li class="fa fa-user"></li></h4>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('facebook')}}" style="background: #366ca4" class="site-btn my-3">
                                Register Facebook
                                <li class="fa fa-facebook mx-3" style="color: #FFFFFF"></li>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('google')}}" style="background: #202326" class="site-btn">
                                Register Google
                                <li class="fa fa-google mx-3" style="color: #FFFFFF"></li>
                            </a>
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

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror

                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout__input">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" style="background: #202326" class="site-btn">Register</button>
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
                    Providers Form Content

                    <form id="providers-register-form" method="POST" action="{{ url('/providers/register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" style="font-family: 'Kdam Thmor Pro', sans-serif; margin-bottom: 0.7rem; font-size: 20px">{{trans('site.restaurant_logo')}}</label>
                            <div class="custom-file h-auto">
                                <input type="file" name="rest_img" class="custom-file-input  @error('rest_img') is-invalid @enderror" id="restaurant-logo" hidden>
                                <label class="border-0 mb-0 cursor" for="restaurant-logo">
                                    <div class="d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; border: 2px solid #ccc; border-radius: 50%;">
                                        <img class="provider-uploaded-logo d-none" id="selected-image" src="" style="max-width: 100%; max-height: 100%;" />
                                        <span id="provider-logo-content" class="d-inline-block">
                    <i class="fa fa-plus fa-fw fa-lg text-gray" aria-hidden="true"></i>
                </span>

                                    <span class="font-body-md mr-2 text-gray">
                                        {{trans('site.add_restaurant_logo')}}
                                            </span>
                                    <p>..</p>

                                    <p id="provider-logo-error" class="alert alert-danger d-none top-margin logo-error">{{trans('site.add_restaurant_logo')}}</p>

                                </label>

                                @error('rest_img')
                                <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div><!-- .form-group logo -->

                        <div class="checkout__input">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form__input @error('name') is-invalid @enderror"  type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="Name" />
                                    @error('name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input class="form__input  @error('user_name') is-invalid @enderror"  type="text" name="user_name" :value="old('name')" autofocus autocomplete="name" placeholder="User Name" />
                                    @error('user_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="checkout__input">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form__input" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" />
                                    @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input class="form__input" id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" placeholder="Mobile" />
                                    @error('mobile')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        <div class="checkout__input">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="form__input  @error('address') is-invalid @enderror"  id="address" class="block mt-1 w-full" type="text" name="address" autocomplete="address" placeholder="Address">
                                    @error('address')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="checkout__input">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form__input  @error('password') is-invalid @enderror"  id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input class="form__input  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Password Confirmation">

                                    @error('address')
                                    <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>


                            </div>

                        </div>


                        <div class="form-group">
                            <label for="ar_details" style="font-family: 'Kdam Thmor Pro', sans-serif; margin-bottom: 0.1rem; font-size: 20px">{{trans('site.abbrev_services_ar')}}</label>
                            <textarea class="form__input form-control font-body-md  @error('ar_details') is-invalid @enderror"
                                      id="provider-ar-details"
                                      name="ar_details"
                                      rows="6"></textarea>
                            <span id="provider-ar-details_error" style="color:red" class="help-block"></span>
                            @error('ar_details')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div><!-- .form-group ar details -->

                        <div class="form-group">
                            <label for="en_details" style="font-family: 'Kdam Thmor Pro', sans-serif; margin-bottom: 0.1rem; font-size: 20px">{{trans('site.abbrev_services_en')}}</label>
                            <textarea class="form__input form-control font-body-md  @error('en_details') is-invalid @enderror"
                                      id="provider-en-details"
                                      name="en_details"
                                      rows="6"></textarea>

                            <span id="provider-en-details_error" style="color:red" class="help-block"></span>
                            @error('en_details')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div><!-- .form-group en details -->
                        <button type="submit" style="background: #202326" class="site-btn">Register</button>
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
