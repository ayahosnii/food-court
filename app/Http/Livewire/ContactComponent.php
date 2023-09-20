<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Livewire\Component;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ];

    public function submitForm()
    {
        try {
            $this->validate();

            ContactUs::create([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]);

            $this->notifySuccess('Message sent successfully.');

            $this->reset();
        } catch (\Exception $e) {
            $this->notifyError('An error occurred while sending the message.');
        }
    }

    private function notifySuccess($message)
    {
        notify()->success($message, 'Success');
    }

    private function notifyError($message)
    {
        notify()->error($message, 'Error');
    }

    public function render()
    {
        return view('livewire.contact-component')
            ->layout('layouts.font-layout');
    }
}
