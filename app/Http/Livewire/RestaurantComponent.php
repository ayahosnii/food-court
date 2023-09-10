<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Livewire\Component;

class RestaurantComponent extends Component
{

    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }




    public function render()
    {
        $name = str_replace('-', ' ', urldecode($this->slug));

        $provider = Provider::where('name', $name)->first();
        $categories = Category::where('provider_id', $provider->id)->get();
        $meals = Meal::where('provider_id', $provider->id)->get();


        return view('livewire.restaurant-component', [
            'provider' => $provider,
            'categories' => $categories,
            'meals' => $meals,
        ])->layout('layouts.restaurants-layout');
    }
}
