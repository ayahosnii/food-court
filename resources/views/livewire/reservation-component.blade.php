<div>
    <section id="gtco-reservation" class="bg-fixed bg-white section-padding overlay" style="background-image: url({{ asset('assets/img/3376542.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-content bg-white p-5 shadow">
                        <div class="heading-section text-center">
                            @if ($step == 1)
                                <span class="subheading">
                                    <h2 style="font-size: 15px; color: #0a53be">Step 1</h2>
                                </span>
                                <h2>
                                    Reservation
                                </h2>

                                <form wire:submit.prevent="nextStep">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12 form-group">
                                            <label for="selectProvider" class="block text-sm font-medium text-gray-700">Select Restaurant</label>
                                            <select name="provider_id" class="form-control" id="selectProvider" wire:model="provider_id">
                                                <option value="">Please Choose Restaurant</option>
                                                @if ($providers)
                                                    @foreach ($providers as $provider)
                                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('provider_id')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label for="res_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                                            <div class="mt-1">
                                                <input type="date" id="res_date" name="res_date" wire:model="res_date" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </div>
                                            @error('res_date')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label for="selectWorkHour" class="block text-sm font-medium text-gray-700">Select Work Hours</label>
                                            <select name="res_time" class="form-control" id="selectWorkHour" wire:model="res_time">
                                                <option value="">Please Choose reservation time</option>
                                                @if ($resTimes)
                                                    @foreach ($resTimes as $resTime)
                                                        <option value="{{ $resTime }}">{{ $resTime }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span style="color: #22c300;" class="text-xs">Please choose the time between 17:00-23:00.</span>
                                            @error('res_time')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest Number</label>
                                            <div class="mt-1">
                                                <input type="number" id="guest_number" name="guest_number" wire:model="guest_number" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </div>
                                            @error('guest_number')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-dark btn-shadow btn-lg" style="color: rgba(161,127,58,0.89)" type="submit" name="submit">Check Availability/Next</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            @if ($step == 2)
                                    <span class="subheading">
                                    <h2 style="font-size: 15px; color: #0a53be">Step 2</h2>
                                </span>
                                    <h2>
                                        Choose the table
                                    </h2>

                                    <form wire:submit.prevent="thirdStep">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-12 form-group">
                                                <label for="selectTable" class="block text-sm font-medium text-gray-700">Select Table</label>
                                                <select name="table_id" class="form-control" id="selectTable" wire:model="table_id">
                                                    <option value="">Please Choose a Table</option>
                                                    @foreach ($availableTableIds as $table)
                                                        <option value="{{ $table->id }}">Table {{ $table->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('table_id')
                                                <div class="text-sm text-red-400">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <div class="panel panel-default credit-card-box">
                                                    <div class="panel-heading display-table" >
                                                        <h3 class="panel-title text-center"><strong>Payment Details</strong></h3>
                                                    </div>
                                                    <div class="panel-body">


                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group required'>
                                                                    <label class='control-label'>Name on Card</label>
                                                                    <input class='form-control' size='4' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group card required'>
                                                                    <label class='control-label'>Card Number</label>
                                                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                    <label class='control-label'>CVC</label>
                                                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                                                </div>
                                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                                                </div>
                                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration Year</label>
                                                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-md-12 error form-group hide'>
                                                                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <button class="btn btn-dark btn-shadow btn-lg" wire:click="submitPayment">Pay Now</button>
                                                                </div>
                                                            </div>


                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12 form-group">
                                                <div id="card-element"></div>


                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>

                                            </div>

                                        </div>

                                            <div class="col-md-12 text-center">

                                                    <button class="btn btn-dark btn-shadow btn-lg" wire:click="submitPayment">Pay Now</button>

                                            <button class="btn btn-dark btn-shadow btn-lg" wire:click="previousStep">Previous</button>


                                                        <button class="btn btn-dark btn-shadow btn-lg" style="color: rgba(161,127,58,0.89)" type="submit" name="submit">Next</button>

                                                                                         </div>
                                    </form>
                                @endif

                                @if ($step == 3)
                                    <span class="subheading">
                                    <h2 style="font-size: 15px; color: #0a53be">Step 3</h2>
                                </span>
                                    <h2>
                                        Write Your
                                    </h2>

                                    <form wire:submit.prevent="storeData">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <input name="name" type="text" class="form-control" wire:model="name" placeholder="Name">
                                            </div>
                                            @error('name')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 form-group">
                                                <input type="text" name="email" class="form-control" wire:model="email" placeholder="Email">
                                            </div>
                                            @error('email')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 form-group">
                                                <input type="number" name="mobile" class="form-control" wire:model="mobile" placeholder="Phone">
                                            </div>
                                            @error('mobile')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-dark btn-shadow btn-lg" wire:click="previousStep">Previous</button>

                                                <button class="btn btn-dark btn-shadow btn-lg" style="color: rgba(161,127,58,0.89)" type="submit" name="submit">Book Now!</button>
                                            </div>
                                        </div>
                                    </form>


                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-notify::notify />
</div>

@push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endpush
