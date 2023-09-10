<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Helper\CountItems;
use App\Models\providers\Meal;
use App\Support\Storage\SessionStorage;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class CartCountComponent extends Component
{
    protected $cart;

    public function mount(Cart $cart)
    {
        $this->cart = $cart;
    }

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function render()
    {
        return view('livewire.cart-count-component', ['itemCount', CountItems::count()]);
    }
}
