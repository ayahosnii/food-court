<?php

namespace App\Http\Livewire;

use App\Models\providers\Provider;
use Livewire\Component;

class AllCourts extends Component
{
    public $provider;

    public function mount(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function render()
    {
        return view('livewire.all-courts');
    }
}
