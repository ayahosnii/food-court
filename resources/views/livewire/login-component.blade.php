<div>
    @livewire('all-courts')

    <!-- Breadcrumb Section Begin -->
    @livewire('hero-section', ['title' => 'Login', 'pageName' => 'Login'])
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
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

                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
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
        </div>
    </section>
    <!-- Checkout Section End -->

</div>
