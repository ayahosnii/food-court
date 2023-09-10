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

                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="row my-3">
                                            <div class="col-md-6">
                                                <label>User <i class="fa fa-user"></i></label>
                                                <input name="user-type" type="radio">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Providers <i class="fa fa-users"></i></label>
                                                <input name="user-type" type="radio">
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button style="background: #0260c0" type="submit" class="site-btn my-3">
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
                                    <div class="checkout__input">
                                        <p>Email</p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Password</p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button style="background: #202326" type="submit" class="site-btn">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

</div>
