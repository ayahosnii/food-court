<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Helper\CountItems;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Http\Request as HttpRequest; // Import the correct Request class

class HomeComponent extends Component
{
    public $slug;
    protected $cart;

    public function addToCart(HttpRequest $request, $slug)
    {
        $meal = Meal::where('slug', $slug)->firstOrFail();


        $cart = new Cart(new SessionStorage('cart'), $meal);

        try {
            $cart->add($meal, $request->input('quantity', 1));
        } catch (QuantityExceededException $e) {
            session()->flash('message', 'Quantity exceeded.');
            return redirect()->back();
        }

        flash('Item added to cart successfully!');
        return redirect()->back();
    }


    public function render()
    {
        $providers = Provider::where('accountactivated', '1')->get();
        $categories = Category::get();
        $meals = Meal::get();
        return view('livewire.home-component', [
            'providers' => $providers,
            'categories' => $categories,
            'meals' => $meals,
        ])->layout('layouts.font-layout');
    }
}
