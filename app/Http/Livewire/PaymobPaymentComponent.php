<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Nafezly\Payments\Classes\PaymobPayment;

class PaymobPaymentComponent extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $res_date;
    public $res_time;
    public $table_id;
    public $guest_number;
    public $provider_id;

    public $paymobPaymentDisplay;
    public $headingSectionDisplay;

    protected $listeners = ['passUserData' => 'storeData'];

    public function mount()
    {
        $this->name = session('user_data.name', '');
        $this->email = session('user_data.email', '');
        $this->mobile = session('user_data.mobile', '');
        $this->res_date = session('user_data.res_date', '');
        $this->res_time = session('user_data.res_time', '');
        $this->table_id = session('user_data.table_id', '');
        $this->guest_number = session('user_data.guest_number', '');
        $this->provider_id = session('user_data.provider_id', '');

        $this->paymobPaymentDisplay = session('user_data.paymobPaymentDisplay', '');
        $this->headingSectionDisplay = session('user_data.headingSectionDisplay', '');
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
        // Use a transaction to ensure data consistency
        DB::beginTransaction();

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

            // You can perform additional actions after reservation creation here.

        } catch (\Exception $e) {
            // Handle any exceptions that occur during reservation creation
            DB::rollBack();
            Log::error('Error creating reservation: ' . $e->getMessage());
            notify()->error('An error occurred while creating the reservation. Please try again later.');
        }
    }



    public function render()
    {
        return view('livewire.paymob-payment-component');
    }
}
