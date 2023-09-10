<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DifferentAddressComponent extends Component
{
    public $ship_to_different;


    public $d_firstname;
    public $d_lastname;
    public $d_province;
    public $d_address;
    public $d_city;
    public $d_zipcode;
    public $d_mobile;
    public $d_email;
    public function render()
    {
        return view('livewire.different-address-component');
    }
}
