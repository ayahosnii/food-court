<?php

namespace App\Http\Livewire;

use App\Models\admin\WorkingHour;
use App\Models\providers\Provider;
use App\Models\providers\Table;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class ReservationComponent extends Component
    {
        public $step = 1;
        public $user;
        public $name;
        public $email;
        public $mobile;
        public $provider_id;
        public $table_id;
        public $res_date;
        public $guest_number;
        public $providers;
        public $availableTables;
        public $availableTableIds = [];

        public $res_time;

        public function mount()
        {
            $this->providers = Provider::where('accountactivated', '1')->get();
        }

        public function nextStep()
        {
            if ($this->step == 1) {
                $this->validateStepOne();
                $isAvailable = $this->checkTableAvailability();

                if (!$isAvailable) {
                    notify()->error('There are no available tables for ' . $this->guest_number . ' person on the selected date and time.');
                    return;
                }

                $tables = Table::whereIn('id', $isAvailable)->get();

                $this->availableTableIds = $tables;
                $this->step = 2;
            }
        }

        public function submitPayment()
        {
            // Set your Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => 1000,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            $this->emit('paymentIntentCreated', $paymentIntent->client_secret);
        }
        public function storeData()
        {
            try {
                $this->validate([
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'mobile' => 'required|string',
                    'res_date' => 'required|date',
                    'res_time' => ['required'],
                    'table_id' => 'required|exists:tables,id',
                    'guest_number' => 'required|integer',
                    'provider_id' => 'required|exists:providers,id',
                ]);

                // Use a transaction to ensure data consistency
                DB::beginTransaction();

                Reservation::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'mobile' => $this->mobile,
                    'res_date' => $this->res_date,
                    'res_time' => $this->res_time,
                    'table_id' => $this->table_id,
                    'guest_number' => $this->guest_number,
                    'provider_id' => $this->provider_id,
                    'reservation_status' => 'reserved',
                    'user_id' => Auth::user()->id ?? null,
                ]);

                // Commit the transaction if all operations are successful
                DB::commit();

                // Reset component properties to clear the input values
                $this->name = '';
                $this->email = '';
                $this->mobile = '';
                $this->res_date = '';
                $this->res_time = '';
                $this->table_id = null;
                $this->guest_number = '';
                $this->provider_id = null;

                notify()->success('Reservation successfully created.');
            } catch (\Exception $e) {

                // Handle the exception
                DB::rollBack(); // Roll back the transaction if an exception occurs

                // You can log the exception or show an error message to the user
                // For now, let's log the exception and show a generic error message
                Log::error('Error creating reservation: ' . $e->getMessage());

                notify()->error('An error occurred while creating the reservation. Please try again later.');
            }
        }

        public function thirdStep()
        {
            if ($this->step == 2) {
                $this->validate([
                    'table_id' => 'required',
                ]);
                $this->step = 3;
            }
        }

        public function previousStep()
        {
            if ($this->step == 2) {
                $this->step = 1;
            }elseif ($this->step == 3){
                $this->step = 2;
            }
        }

        private function checkTableAvailability()
        {
            // Find a table that can accommodate the selected guest number and belongs to the selected provider
            $tables = Table::where('guest_number', '>=', $this->guest_number)
                ->where('provider_id', $this->provider_id)
                ->get();

            if ($tables->isEmpty()) {
                return false;
            }
            $tableIds = $tables->pluck('id')->toArray();


            // Check if there are any reservations for the selected date and the found table
            $existingReservation = Reservation::where('res_date', $this->res_date)
                ->whereIn('table_id', $tables->pluck('id'))
                ->where('reservation_status', 'reserved')
                ->get();


            if (!$existingReservation->isEmpty()) {
                return false;
            }

            $reservedTableIds = $existingReservation->pluck('table_id')->toArray();

            $availableTableIds = array_diff($tableIds, $reservedTableIds);

            return $availableTableIds;
        }



        public function workHours()
        {
            $workingHours = WorkingHour::first();
            $start_time = Carbon::parse($workingHours->start_time);
            $end_time = Carbon::parse($workingHours->end_time);

            $current_time = $start_time;
            $time_intervals = [];

            while ($current_time < $end_time) {
                $time_intervals[] = $current_time->format('H:i:s');
                $current_time->addHour();
            }
            return $time_intervals;
        }

        private function validateStepOne()
        {
            $this->validate([
                'provider_id' => 'required',
                'res_date' => ['required', 'date', $this->validateDateTimeNotBeforeNow($this->res_date, $this->res_time)],
                'guest_number' => 'required|integer',
                'res_time' => 'required'
            ]);
        }

        private function validateDateTimeNotBeforeNow($date, $time)
        {
            // Combine the date and time inputs into a single datetime string
            $dateTimeInput = $date . ' ' . $time;

            // Parse the datetime input
            $selectedDateTime = Carbon::parse($dateTimeInput);

            // Get the current date and time
            $currentDateTime = Carbon::now();

            // Check if the selected datetime is before the current datetime
            if ($selectedDateTime->lt($currentDateTime)) {
                return 'after_or_equal:' . $currentDateTime->toDateTimeString();
            }

            return '';
        }



        public function render()
        {
            $resTimes = $this->workHours();
            if ($this->step == 2) {
                // Fetch available tables for the selected provider and reservation date
            }

            return view('livewire.reservation-component', ['resTimes' => $resTimes])->layout('layouts.font-layout');
        }
    }
