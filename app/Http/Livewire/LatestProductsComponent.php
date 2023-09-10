<?php

namespace App\Http\Livewire;

use App\Models\providers\Meal;
use Livewire\Component;

class LatestProductsComponent extends Component
{
    public $lastSixMeals;

    public function mount()
    {
        // Fetch the last six meals and assign them to the public property
        $this->lastSixMeals = Meal::latest()->limit(6)->get();
    }

    public function render()
    {
        return view('livewire.latest-products-component');
    }
}
