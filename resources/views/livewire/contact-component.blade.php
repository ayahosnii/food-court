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
    @livewire('hero-section', ['title' => 'Contact-Us', 'pageName' => 'Contact-Us'])
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+20 11.188.888</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>Cairo Governorate</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>11:00 am to 23:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>food-court@site.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34556.823499993675!2d31.235711536154927!3d30.044419617213937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145838f79f7eef09%3A0x7559c512954f99d6!2sCairo%2C%20Egypt!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>Cairo</h4>
                <ul>
                    <li>Phone: +20 11.188.888</li>
                    <li>Add: Cairo Governorate, Egypt</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form wire:submit.prevent="submitForm">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input name="name" wire:model="name" type="text" placeholder="Your name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input name="email" wire:model="email" type="email" placeholder="Your Email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="message" wire:model="message" placeholder="Your message"></textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="submit" style="background: #735845;" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
    <x-notify::notify />
</div>
