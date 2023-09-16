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
                                                <div id="card-element"></div>


                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>

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

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener("livewire:load", function() {
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
        });
    </script>
@endpush
