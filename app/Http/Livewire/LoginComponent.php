<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public $errorMessage;
    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication succeeded, redirect to dashboard or another page
            return redirect()->route('home');
        } else {
            // Authentication failed, show an error message
            $this->errorMessage = 'Invalid credentials. Please try again.';
        }
    }
    public function render()
    {
        return view('livewire.login-component')->layout('layouts.font-layout');
    }
}
