<?php

namespace App\Http\Livewire;

use App\Models\providers\Provider;
use Livewire\Component;

class ReservationComponent extends Component
{
    public $step = 1;
    public $user;
    public $name;
    public $email;
    public $mobile;
    public $provider_id;
    public $res_date;
    public $guest_number;
    public $providers;
    public $availableTables;


    public function mount()
    {
        $this-> providers = Provider::where('accountactivated', '1')->get();
    }
    public function nextStep()
    {
//        $this->validateStepOne(); // Implement validation rules for step one fields

        if ($this->step == 1) {
            $this->step = 2;
        }
    }

    public function previousStep()
    {
        $this->step = 1;
    }

//    private function validateStepOne()
//    {
//        $this->validate([
//            'name' => 'required|string',
//            'email' => 'required|email',
//            'mobile' => 'required|string',
//            'provider_id' => 'required|exists:providers,id',
//            'res_date' => 'required|date',
//            'guest_number' => 'required|integer',
//        ]);
//    }

    public function render()
    {

        if ($this->step == 2) {
            // Fetch available tables for the selected provider and reservation date
        }



        return view('livewire.reservation-component')->layout('layouts.font-layout');
    }
}
