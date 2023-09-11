<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegisterComponent extends Component
{
    public $userType = 'user'; // Set a default user type

    public function switchToUser()
    {
        $this->userType = 'user';
    }

    public function switchToProviders()
    {
        $this->userType = 'providers';
    }

    public function render()
    {
        return view('livewire.register-component');
    }
}
