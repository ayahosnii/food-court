<div>
    <section id="gtco-reservation" class="bg-fixed bg-white section-padding overlay" style="background-image: url({{ asset('assets/img/3376542.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-content bg-white p-5 shadow">
                        <div class="heading-section text-center">
                            @if ($step == 1)
                                <span class="subheading">
                                    Step 1
                                </span>
                                <h2>
                                    Reservation
                                </h2>
                            @endif
                            <form wire:submit.prevent="nextStep">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" wire:model="name" placeholder="Name">
                                    </div>
                                    @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" wire:model="email" placeholder="Email">
                                    </div>
                                    @error('email')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-12 form-group">
                                        <input type="number" class="form-control" wire:model="mobile" placeholder="Phone">
                                    </div>
                                    @error('mobile')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-12 form-group">
                                        <select name="provider_id" class="form-control" id="selectProvider" wire:model="provider_id">
                                            <optgroup label="Please Choose Restaurant">
                                                @if ($providers)
                                                    @foreach ($providers as $provider)
                                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date </label>
                                        <div class="mt-1">
                                            <input type="date" id="res_date" name="res_date" wire:model="res_date" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                        <span class="text-xs">Please choose the time between 17:00-23:00.</span>
                                        @error('res_date')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number </label>
                                        <div class="mt-1">
                                            <input type="number" id="guest_number" name="guest_number" wire:model="guest_number" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                        @error('guest_number')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-dark btn-shadow btn-lg" style="color: rgba(161,127,58,0.89)" type="submit" name="submit">Next</button>
                                    </div>
                                </div>
                            </form>
                            @if ($step == 2)
                                <span class="subheading">
                                    Step 2
                                </span>
                                <!-- Step 2: Display available tables -->

                                @if ($availableTables->count() > 0)
                                    <!-- Display the available tables based on the fetched data -->
                                    <ul>
                                        @foreach ($availableTables as $table)
                                            <li>
                                                <button wire:click="selectTable({{ $table->id }})">Select Table</button>
                                                {{ $table->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <h3>No available tables found for the selected provider and date.</h3>
                                    <button class="btn btn-dark btn-shadow btn-lg" wire:click="previousStep">Previous</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
