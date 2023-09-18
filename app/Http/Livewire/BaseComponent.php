<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Helper\MealCategorySorter;
use App\Models\providers\Meal;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BaseComponent extends Component
{
    public $price_range = [];

    public $slug;

    protected $cart;
    public $sorting;
    public $pagesize;
    public $category_slug;
    public $debug;

    public $min_price;
    public $max_price;

    public $min_alphabet;
    public $max_alphabet;

    public $min_date;
    public $max_date;
    public $cartItemCount = 0;

    public $filterProviders = [], $categoryInputs = [];




    protected $listeners = ['favoriteToggled' => 'refreshFavoriteStatus'];

    public $favoriteMeals = [];


    public function refreshFavoriteStatus($slug)
    {

    }


    public function toggleFavorite($slug)
    {
        $user = Auth::user();

        if (!$user) {
            notify()->error('You must login first');
        }else{
            $meal = Meal::where('slug', $slug)->firstOrFail();

            if ($user->favoriteMeals->contains($meal)) {
                $user->favoriteMeals()->detach($meal);
            } else {
                $user->favoriteMeals()->attach($meal);
            }

            $meal->refresh();

            $this->emit('favoriteToggled', $meal->slug);
            $this->emitTo('wishlist-count-component', 'refreshComponent');
        }

    }

    public function addToCart(HttpRequest $request, $slug)
    {
        $meal = Meal::where('slug', $slug)->firstOrFail();
        $cart = new Cart(new SessionStorage('cart'), $meal);

        try {
            $cart->add($meal, $request->input('quantity', 1));

            $this->cartItemCount = $cart->itemCount();

            $this->emitTo('cart-count-component', 'refreshComponent');

        } catch (QuantityExceededException $e) {
            session()->flash('message', 'Quantity exceeded.');
            return redirect()->back();
        }

        notify()->success('Item added to cart successfully!');
        return redirect()->back();
    }

    public function updatedCategoryInputs()
    {
        // Create a new instance of the meals query
        $mealsQuery = Meal::query();

        // Call the filterByCategory method to apply the category filter
        $mealsQuery = MealCategorySorter::filterByCategory($mealsQuery, $this->categoryInputs);

        if (!empty($this->filterProviders)) {
            $mealsQuery->whereIn('provider_id', $this->filterProviders);
        }

        // Apply the price range filter
        if (!empty($this->min_price) && !empty($this->max_price)) {
            $mealsQuery->whereBetween('price', [$this->min_price, $this->max_price]);
        }

        return $mealsQuery;
    }


}
