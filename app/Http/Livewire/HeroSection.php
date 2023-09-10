<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeroSection extends Component
{
    public $title;
    public $pageName;

    public function mount($title, $pageName)
    {
        $this->title = $title;
        $this->pageName = $pageName;
    }

    public function render()
    {
        return view('livewire.hero-section');
    }
}
