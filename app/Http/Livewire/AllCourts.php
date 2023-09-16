<?php

namespace App\Http\Livewire;

use App\Models\providers\Provider;
use Livewire\Component;

class AllCourts extends Component
{
    public $provider;

    public function mount()
    {
        $this->provider = Provider::where('accountactivated', '1')->first();
    }

    public function render()
    {
        return view('livewire.all-courts');
    }
}
