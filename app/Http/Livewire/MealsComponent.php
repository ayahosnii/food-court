<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Events\CartItemCountUpdated;
use App\Exceptions\QuantityExceededException;
use App\Helper\MealCategorySorter;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MealsComponent extends Component
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


    public function mount()
    {
        $this->sorting = "price";
        $this->pagesize = "12";

        $this->min_price=1;
        $this->max_price=1000;

        $this->min_alphabet='a';
        $this->max_alphabet='z';
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

            // Update the favorite status in the current meal object
            $meal->refresh();

            // Emit an event to update the heart icon's color
            $this->emit('favoriteToggled', $meal->slug);
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



    public function render()
    {
        $providers = Provider::get();
        $categories = Category::get();

        // Create a new instance of the meals query
        $mealsQuery = Meal::query();

        // Apply the category filter
        $mealsQuery = MealCategorySorter::filterByCategory($mealsQuery, $this->categoryInputs);

        // Apply provider filtering if provider IDs are selected
        if (!empty($this->filterProviders)) {
            $mealsQuery->whereIn('provider_id', $this->filterProviders);
        }
        if (!empty($this->min_price) && !empty($this->max_price)) {
            $mealsQuery->whereBetween('price', [$this->min_price, $this->max_price]);
        }

        // Apply sorting using the scope
        $mealsQuery->sortBy($this->sorting, $this->pagesize);

        // Paginate the results
        $meals = $mealsQuery->paginate($this->pagesize);

        return view('livewire.meals-component', [
            'providers' => $providers,
            'categories' => $categories,
            'meals' => $meals,
            'cartItemCount' => $this->cartItemCount,
        ])->layout('layouts.font-layout');
    }
}
