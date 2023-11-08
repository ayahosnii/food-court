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
use Mockery\Exception;
use Nafezly\Payments\Classes\PaymobPayment;
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
    public $paymobPaymentDisplay = 'none';
    public $headingSectionDisplay = 'block';


    public function mount()
    {
        $this->providers = Provider::where('accountactivated', '1')->get();

        $this->emit('passUserData', [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'res_date' => $this->res_date,
            'res_time' => $this->res_time,
            'table_id' => $this->table_id,
            'guest_number' => $this->guest_number,
            'provider_id' => $this->provider_id,
            'paymobPaymentDisplay' => $this->paymobPaymentDisplay,
            'headingSectionDisplay' => $this->headingSectionDisplay
        ]);

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

            $this->emit('passUserData', [
                'res_date' => $this->res_date,
                'res_time' => $this->res_time,
                'guest_number' => $this->guest_number,
                'provider_id' => $this->provider_id,


                'paymobPaymentDisplay' => $this->paymobPaymentDisplay,
                'headingSectionDisplay' => $this->headingSectionDisplay
            ]);

            $this->availableTableIds = $tables;
            $this->step = 2;
        }
    }


public function thirdStep()
{
    if ($this->step == 2) {
        $this->validate([
            'table_id' => 'required',
        ]);

        $this->emit('passUserData', [
            'table_id' => $this->table_id,
        ]);

        //$this->submitPayment();

        // Only move to step 3 if payment submission is successful

            $this->step = 3;

    }
}
    public function paymobPay()
    {
        $payment = new PaymobPayment();
        $response = $payment
            ->setUserFirstName($this->name)
            ->setUserLastName('hosny')
            ->setUserEmail($this->email)
            ->setUserPhone($this->mobile)
            ->setAmount(5)
            ->setCurrency('EGP')
            ->pay();


        return redirect($response['redirect_url']);
    }

    public function storeData()
    {

        try {
            $reservation = Reservation::create([
                'name' => $this->name,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'res_date' => $this->res_date,
                'res_time' => $this->res_time,
                'table_id' => $this->table_id,
                'guest_number' => $this->guest_number,
                'provider_id' => $this->provider_id,
                'reservation_status' => 'reserved',
                'booked_price' => '5.00',
                'user_id' => Auth::user()->id ?? null,
            ]);

            $this->paymobPay();

            notify()->success('Reservation successfully created.');

            // You can perform additional actions after reservation creation here.

        } catch (\Exception $e) {
            dd($e);
            // Handle any exceptions that occur during reservation creation
            DB::rollBack();
            Log::error('Error creating reservation: ' . $e->getMessage());
            notify()->error('An error occurred while creating the reservation. Please try again later.');
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


public function toggleStyles()
{
    if ($this->paymobPaymentDisplay === 'block') {
        $this->paymobPaymentDisplay = 'none';
        $this->headingSectionDisplay = 'block';
    } else {
        $this->paymobPaymentDisplay = 'block';
        $this->headingSectionDisplay = 'none';
    }
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
