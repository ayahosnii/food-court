<div>
    <section id="gtco-reservation" class="bg-fixed bg-white section-padding overlay" style="background-image: url({{ asset('assets/img/3376542.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-content bg-white p-5 shadow">
                        <div class="paymob-payment" style="display: {{ $paymobPaymentDisplay }};">
                            <h2>
                                Confirm the payment by pay 5$
                            </h2>

                            <img src="/static/img/arrow_corner_up.svg" class="arrow1"
                                 style="position: absolute;opacity: 0.1;width: 13%;z-index: -1;">

                            <div class="containers">
                                <div class="row formRowContainer">
                                    <div class="col-md-12 col-sm-12">
                                        <section class="cards">
                                            <div class="card-wrapper">

                                            </div>
                                        </section>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <section class="card-inputs">
                                            <form id="paymob_checkout">
                                                <input type="hidden" value="CARD" paymob_field="card_number" id="card_number">
                                                <input type="hidden" value="CARD" paymob_field="card_expiry_mm" id="mm">
                                                <input type="hidden" value="CARD" paymob_field="card_expiry_yy" id="yy">
                                                <input type="hidden" value="" name="tenure" paymob_field="tenure" id="tenureHiddenInput">
                                                <input type="hidden" value="CARD" paymob_field="subtype">
                                                <input type="hidden" value="" name="slug" />
                                                <div class="card-num-input">
                                                    <input placeholder="Card Number" onchange="update_two_hidden_fields();" type="tel" name="number"
                                                           id="number" class="card-num">
                                                </div>
                                                <div class="checkInstallmentTextDiv">
                                                    <p>Your card is eligible for installments</p>
                                                    <span>Check Installment Plans</span>
                                                </div>
                                                <div class="card-num-input">
                                                    <input placeholder="Card Holder Name" type="text" name="name" paymob_field="card_holdername">
                                                </div>
                                                <div class="input-containers">
                                                    <input placeholder="MM/YY" onchange="update_two_hidden_fields();" type="tel" name="expiry"
                                                           id="mmyy">
                                                    <input placeholder="CVV" type="tel" name="cvc" paymob_field="card_cvn">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="saveCardText">Save Card <input type="checkbox" value="tokenize" name="save card">
                                                    </div>
                                                    <div id="discountMessgae"></div>
                                                    <button id="submitButtonWaiting" class="submit" style="display: block;" disabled>
                                                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                                    </button>
                                                    <input id="submitButton" type="submit" value="PAY" class="submit" style="display: none;">
                                                    <span><i class="fa fa-lock" aria-hidden="true"></i> Secured by Paymob</span>
                                                    <div id="checkInstallmentBtn" class="whiteBtn">Check Installment Plans</div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                                <div class="installmentsDiv">
                                    <div class="installmentsHead">
                                        <img src="/static/img/paymob_new.svg" />
                                        <p>Choose your plan</p>
                                    </div>
                                    <div id="installmentsBody"></div>
                                </div>
                            </div>

                            <img src="/static/img/arrow_corner_down.svg" style="position: absolute; opacity: 0.1; z-index: -1;width: 13%;"
                                 class="arrow2">

                            <button wire:click="toggleStyles" class="btn btn-success">Next</button>
                        </div>
                        <div class="heading-section text-center" style="display: {{ $headingSectionDisplay }};">
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

                                            </div>

                                        <div class="col-md-12 text-center">

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

@push('styles')
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @font-face {
            font-family: 'Gotham';
            src: url('/static/fonts/Gotham-Medium.otf');
            font-weight: 400;
            font-style: normal;
        }

        html {
            background: #F2F2F2;
        }

        body {
            position: relative;
        }

        .containers {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 0px 23px #0080F917;
            border-radius: 24px;
            max-width: 100%;
            height: 100%;
            margin: auto;
            display: block;
            margin-top: 6%;

        }

        .cards {
            display: inline-block;
        }

        .card-inputs {
            padding-top: 15px;
        }

        .card-num-input {
            display: flex;
            margin: auto;
        }

        .card-num {
            background-image: url('data:image/png;base64,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') !important;
            background-origin: content-box;
            background-repeat: no-repeat;
            background-position: right;
        }

        .card-num-input input {
            padding: 10px 10px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 1px 2px 5px whitesmoke;
            margin-bottom: 0.5rem;
            border: 1px solid #B5CFE8;
            border-radius: 15px;
            opacity: 1;
            height: 25px;
            font-size: 18px;
            color: #7F98C5;
            font-weight: 300;
            font-family: "Gotham";
        }

        .card-num-input input::placeholder,
        .input-containers input::placeholder {
            text-align: left;
            font-size: 18px;
            font-weight: 300;
            font-family: "Gotham";
            letter-spacing: 0px;
            color: #7F98C5;
            opacity: 1;
        }

        .card-num-input input:focus,
        .card-num-input input:hover,
        .input-containers input:focus,
        .input-containers input:hover {
            border: 1px solid #1782FB;
            border-radius: 15px;
            outline: none;
        }

        .input-containers {
            display: flex;
            justify-content: space-between;
            margin: auto;
            width: 100%;
            text-align: center;
        }

        .input-containers input {
            width: calc(50% - 5px);
            display: inline-block;
            padding: 20px 10px;
            border-radius: 10px;
            box-shadow: 1px 2px 5px whitesmoke;
            margin-bottom: 0.5rem;
            border: 1px solid #B5CFE8;
            border-radius: 15px;
            height: 25px;
            font-size: 18px;
            color: #7F98C5;
            font-weight: 300;
            font-family: "Gotham";
            box-sizing: border-box;
            margin: 0px !important;
        }

        .input-containers input:first-child {
            margin-right: 0.5rem;
        }

        #number {
            margin-top: 1rem;
        }

        .jp-card {
            margin-top: 1rem;
            min-width: 0px !important;
            min-height: 247px !important;
        }

        .jp-card .jp-card-front,
        .jp-card .jp-card-back {
            background-image: url('data:image/png;base64,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') !important;
            margin: auto;
            background-position: top right !important;
            background-size: cover !important;
            line-height: 1;
            width: 100% !important;
            height: 100% !important;
            background-origin: content-box !important;
        }

        .visa-logo {
            width: 40%;
            float: left;
            text-align: left;
            padding-left: 1rem;
            margin-top: 1rem;
        }

        .bg {
            float: right;
        }

        .bg-path {
            position: absolute;
            height: 170px;
        }

        .companyName {
            width: 40%;
            text-align: center;
            margin-right: 2rem;
            margin-top: 1rem;
            position: relative;
            padding-left: 1rem;
        }

        .card-icon {
            width: 36%;
            float: left;
            text-align: right;
            padding-right: 1rem;
            margin-top: 1rem;
        }

        .cardNum {
            width: 100%;
            float: left;
            text-align: left;
            padding-left: 1.3rem;
            margin-top: 1rem;
        }

        .cardNum span {
            text-align: left;
            font-size: 16px;
            font-weight: 300;
            font-family: 'Gotham';
            letter-spacing: 0px;
            color: #01338D;
            margin-bottom: 0.5rem;
            display: block;
        }

        .cardNum p {
            text-align: left;
            font-size: 25px;
            font-weight: 300;
            font-style: normal;
            font-family: 'Gotham';
            color: #FFFFFF;
            margin: auto;
            letter-spacing: 2.88px;
            opacity: 1;
        }

        .section3 {
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .Name {
            width: 42%;
            text-align: left;
            padding-left: 1rem;
            float: left;
            margin: auto;
        }

        .date,
        .cvv {
            width: 26%;
            float: left;
            margin: auto;
            text-align: center;
        }

        .jp-card .jp-card-front .jp-card-lower .jp-card-expiry:before,
        .jp-card .jp-card-front .jp-card-lower .jp-card-name:before {
            font-weight: 300 !important;
            font-style: normal;
            font-family: 'Gotham' !important;
            font-size: 11px !important;
            color: #01338D !important;
            margin-bottom: 0.5rem !important;
            opacity: 1 !important;
        }

        .jp-card .jp-card-front .jp-card-lower .jp-card-name {
            width: 50% !important;
            text-transform: none !important;
        }

        .jp-card .jp-card-front .jp-card-lower .jp-card-number:before {
            content: attr(data-before);
            margin-bottom: 2px;
            font-size: 7px;
            text-transform: uppercase;
            font-weight: 300 !important;
            font-style: normal;
            font-family: 'Gotham' !important;
            font-size: 11px !important;
            display: inline-grid;
            width: 100%;
            letter-spacing: 0.58px !important;
            color: #01338D !important;
            margin-bottom: 0.5rem !important;
            opacity: 1 !important;
        }

        .jp-card .jp-card-front .jp-card-lower .jp-card-name:before {
            content: attr(data-before);
            margin-bottom: 2px;
            font-size: 7px;
            text-transform: uppercase;
            font-weight: 300 !important;
            font-style: normal;
            font-family: 'Gotham' !important;
            font-size: 11px !important;
            display: inline-grid;
            width: 100%;
            letter-spacing: 0.58px !important;
            color: #01338D !important;
            margin-bottom: 0.5rem !important;
            opacity: 1 !important;
        }

        .jp-card .jp-card-front .jp-card-lower {
            left: 6% !important;
        }

        .jp-card .jp-card-front .jp-card-lower .jp-card-name,
        .jp-card .jp-card-front .jp-card-lower .jp-card-expiry {
            font-weight: 300 !important;
            font-style: normal;
            text-transform: none;
            font-family: 'Gotham' !important;
            font-size: 14px !important;
            letter-spacing: 0px !important;
            color: #FFFFFF !important;
            opacity: 0.37;
        }

        .jp-card-paymob {
            position: absolute;
            opacity: 0;
            right: 10px !important;
            top: 15px;
            -webkit-transition: 400ms;
            -moz-transition: 400ms;
            transition: 400ms;
        }

        .jp-card-display.jp-card-paymob::before,
        .jp-card-display.jp-card-paymob::after {
            display: block;
            position: relative;
        }

        .jp-card .jp-card-front .jp-card-display,
        .jp-card .jp-card-back .jp-card-display {
            opacity: 1 !important;
        }

        .jp-card-display.jp-card-paymob::before {
            content: url('data:image/png;base64,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');
            width: 100%;
            position: relative;
            height: 100%;
            display: block;
            right: 5% !important;
            opacity: 1 !important;
        }

        .jp-card .jp-card-front .jp-card-shiny:before {
            background: none !important;
        }

        .jp-card .jp-card-front .jp-card-shiny {
            float: right;
            margin-right: -13% !important;
            position: absolute !important;
            top: 50px;
            left: 0px;
            background: url('data:image/png;base64,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') no-repeat center center !important;
            background-size: 100% 100% !important;
            margin-top: -22%;
            position: none !important;
            width: 45px !important;
        }

        .jp-card .jp-card-front .jp-card-logo {
            left: 5% !important;
        }

        footer {
            width: 100%;
        }

        .card-footer {
            margin: auto;
            width: 100%;
            display: block;
            margin-top: 0.5rem;
            text-align: center;
        }

        .card-footer .submit {
            background: #1782FB 0% 0% no-repeat padding-box;
            border-radius: 11px;
            border: none;
            padding: 0px;
            text-align: center;
            font-family: 'Gotham';
            font-weight: 300;
            letter-spacing: 0px;
            color: #FFFFFF;
            /* display: block; */
            margin: auto;
            cursor: pointer;
            width: 100%;
            height: 45px;
            font-size: 19px;
            line-height: 45px;
            transition: all ease-in-out .3s;
        }

        .card-footer .submit:hover {
            transform: translateY(-2px);
            box-shadow: 2px 2px 6px #ccc;
        }

        .whiteBtn {
            background: transparent;
            border-radius: 11px;
            border: 1px solid #1782FB;
            padding: 0px;
            text-align: center;
            font-family: 'Gotham';
            font-weight: 300;
            letter-spacing: 0px;
            color: #1782FB;
            /* display: block; */
            margin: auto;
            cursor: pointer;
            width: 100%;
            height: 45px;
            font-size: 19px;
            line-height: 45px;
            transition: all ease-in-out .3s;
        }

        .whiteBtn:hover {
            background-color: #1782FB;
            color: #fff;
        }

        .card-footer span {
            text-align: center;
            font-size: 13px;
            font-family: 'Gotham';
            font-weight: 300;
            letter-spacing: 0px;
            color: #7F98C5;
            padding-top: 5px;
            display: block;
            padding-bottom: 10px;
        }

        .saveCardText {
            text-align: center;
            font-size: 13px;
            font-family: 'Gotham';
            font-weight: 300;
            letter-spacing: 0px;
            color: #7F98C5;
            display: block;
            padding-bottom: 1rem;
        }

        footer {
            padding-bottom: 1rem;
        }

        .copyWrite {
            margin: auto;
            margin-top: 30px;
        }

        .copyWrite img {
            display: block;
            margin: auto;
        }

        .copyWrite span {
            text-align: center;
            font-size: 12px;
            font-family: 'Gotham';
            font-weight: 300;
            font-style: normal;
            letter-spacing: 0px;
            color: #7F98C5;
            margin-top: 0.5rem;
            display: block;

        }

        @media only screen and (max-width: 600px) {
            .containers {
                width: 100%
            }

            .cards {
                width: 93%;
                margin-left: 15px;
                margin-right: 15px;
            }

            .card-inputs {
                width: 415px;
                max-width: 100%;
                padding-top: 0px;
                margin: auto;
            }

            .jp-card .jp-card-front .jp-card-shiny {
                display: block;
            }

            #paymob_checkout {
                padding: 0px 15px;
            }

            .arrow1 {
                display: none;
            }

            .arrow2 {
                display: none;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .containers {
                width: 70%;
            }

            .cards {
                width: 100%;
                float: none;
                margin: auto;
            }

            .card-inputs {
                width: 415px;
                max-width: 100%;
                margin: auto;
                padding-top: 0px;
            }

            .jp-card .jp-card-front .jp-card-shiny {
                display: block;
            }

            .arrow1 {
                display: none;
            }

            .arrow2 {
                display: none;
            }
        }

        @media only screen and (min-width: 768px) {
            .jp-card .jp-card-front .jp-card-shiny {
                display: block;
            }

            .card-inputs {
                width: 415px;
                max-width: 100%;
                margin: auto;
                padding-top: 15px;
            }
        }

        @media only screen and (min-width: 992px) {
            .cards {
                width: 49%;
                float: left;
                padding-left: 0.5rem;
                padding-top: 15px;
                padding-bottom: 1rem;
            }

            .jp-card .jp-card-front .jp-card-shiny {
                display: block;
            }

            .jp-card-container {
                float: left;
            }

            .jp-card {
                margin-top: 1rem;
                width: 415px !important;
                min-width: 415px !important;
                min-width: 0px !important;
            }

            .card-inputs {
                width: 46%;
                display: inline-block;
                padding-left: 1rem;
            }

            .containers {
                width: 880px;
                padding: 0rem 2rem;
            }

            .arrow1 {
                right: 3%;
                top: 0%;
                display: block;
            }

            .arrow2 {
                left: 2%;
                display: block;
                bottom: auto;
            }
        }

        #discountMessgae {
            display: none;
            text-align: center;
            font-size: 18px;
            font-family: 'Gotham';
            letter-spacing: 0px;
            color: #7F98C5;
            margin-bottom: 10px;
        }

        #submitButton:disabled {
            cursor: not-allowed;
            background-color: #E8E8E8;
            border: none;
            color: #fff;
        }

        #submitButtonWaiting {
            display: none;
        }

        #submitButtonWaiting>i {
            font-size: 20px;
        }

        .checkInstallmentTextDiv {
            display: none;
            width: 100%;
            height: 30px;
            padding: 0px 5px;
            box-sizing: border-box;
        }

        .checkInstallmentTextDiv p {
            display: inline-block;
            float: left;
            margin: 0px;
            font-size: 14px;
            line-height: 25px;
            color: #00C814;
        }

        .checkInstallmentTextDiv span {
            display: inline-block;
            float: right;
            margin: 0px;
            font-size: 14px;
            line-height: 25px;
            color: #1782FB;
            text-decoration: underline;
        }

        .checkInstallmentTextDiv span:hover {
            cursor: pointer;
            text-decoration: underline;
        }

        @media only screen and (max-width: 600px) {
            .checkInstallmentTextDiv {
                width: 100%;
                height: 60px;
            }

            .checkInstallmentTextDiv p {
                text-align: center;
                display: block;
                width: 100%;
            }

            .checkInstallmentTextDiv span {
                text-align: center;
                display: block;
                width: 100%;
            }
        }

        .installmentsDiv {
            display: none;
            margin: 30px 0px;
        }

        .installmentsHead {
            text-align: center;
            margin-bottom: 15px;
        }

        .installmentsHead>img {
            height: 35px;
            width: auto;
            margin: auto;
        }

        .installmentsHead p {
            font-size: 20px;
            color: #01338D;
            margin: 0px;
        }

        #installmentsBody {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0px 15px;
        }

        #installmentsBody .installmentsEle {
            display: inline-block;
            border: 2px solid #BFDFFD;
            border-radius: 15px;
            text-align: center;
            height: 50px;
            min-width: 150px;
            padding: 10px 0px;
            margin: 0px 7px;
            margin-bottom: 15px;
            transition: all ease-in-out .3s;
        }

        #installmentsBody .installmentsEle>p {
            line-height: 26px;
            font-size: 22px;
            color: #01338D;
            margin: 0px;
            margin-bottom: 5px;
        }

        #installmentsBody .installmentsEle>span {
            list-style: 18px;
            font-size: 15px;
            color: #0080F9;
        }

        #installmentsBody .installmentsEle.selected {
            border: 2px solid #0080F9;
        }

        #installmentsBody .installmentsEle:hover {
            cursor: pointer;
            border: 2px solid #0080F9;
        }


        #checkInstallmentBtn {
            display: none;
        }

        .formRowContainer {
            min-height: 300px;
        }

        .installmentsSubmitDiv {
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        .installmentsSubmitDiv>input {
            background: #1782FB 0% 0% no-repeat padding-box;
            border-radius: 11px;
            border: none;
            padding: 0px;
            text-align: center;
            font-family: 'Gotham';
            font-weight: 300;
            letter-spacing: 0px;
            color: #FFFFFF;
            /* display: block; */
            margin: auto;
            cursor: pointer;
            width: 400px;
            max-width: 100%;
            height: 45px;
            font-size: 19px;
            line-height: 45px;
            outline: none !important;
            transition: all ease-in-out .3s;
        }

        .installmentsSubmitDiv>input:hover {
            transform: translateY(-2px);
            box-shadow: 2px 2px 6px #ccc;
        }

        .installmentsSubmitDiv>input:disabled {
            cursor: not-allowed;
            opacity: .4;
        }

        .copyWrite .logos {
            text-align: center;
            margin-top: 25px;
        }

        .copyWrite .logos>img {
            display: inline-block;
            height: 26px;
            margin: 5px;
        }

    </style>
@endpush
