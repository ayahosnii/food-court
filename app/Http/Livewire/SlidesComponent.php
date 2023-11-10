<?php

namespace App\Http\Livewire;

use App\Models\admin\Banner;
use Livewire\Component;

class SlidesComponent extends Component
{
    public $banners; // Define the property to hold the banners data

    public function mount()
    {
        $this->banners = Banner::get(); // Assign data to the property
    }

    public function render()
    {
        return view('livewire.slides-component', [
            'banners' => $this->banners, // Pass the banners data to the view
        ]);
    }
}
