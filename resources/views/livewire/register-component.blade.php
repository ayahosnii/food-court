<div>

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

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="col-md-12">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label>User <i class="fa fa-user"></i></label>
                                <input type="radio" name="userType" value="user" wire:model="userType">
                            </div>
                            <div class="col-md-6">
                                <label>Providers <i class="fa fa-users"></i></label>
                                <input type="radio" name="userType" value="providers" wire:model="userType">
                            </div>
                        </div>
                    </div>

                    @if($userType === 'user')
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
                                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
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
                    @endif

                    @if($userType === 'providers')
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="row">
                                    <!-- Provider registration form here -->
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <!-- Display order summary or additional information if needed -->
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>
</div>


{{--
<div>
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

                @if($userType)

                @endif
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row my-3">
                                        <div class="col-md-6">
                                            <label>User <i class="fa fa-user"></i></label>
                                            <input type="radio" name="userType" value="user" wire:model="userType">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Providers <i class="fa fa-users"></i></label>
                                            <input type="radio" name="userType" value="providers" >
                                        </div>
                                    </div>
                                </div>
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
    </section>
</div>
--}}
