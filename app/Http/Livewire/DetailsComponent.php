<?php

namespace App\Http\Livewire;

use App\Exceptions\QuantityExceededException;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\providers\Meal;
use App\Models\Rating;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;
    public $rating;
    public $name;
    public $comment;
    public $selectedAttributePrice;

    public $favoriteMeals = [];

    public function calculateTotalPrice()
    {
        // Calculate the total price based on the meal's base price and the selected attribute's price
        $meal = Meal::where('slug', $this->slug)->first();
        $basePrice = $meal->price;
        $totalPrice = $basePrice + $this->selectedAttributePrice;

        return $totalPrice;
    }

    public function refreshFavoriteStatus($slug)
    {

    }


    public $attributes;
    public $options;

    private function loadAttributesAndOptions($meal)
    {
        $this->options = $meal->options;
    }

    public function mount($slug){

        $this->slug = $slug;
        $this->qty = 1;
        $meal = Meal::where('slug', $slug)->first();
        $this->loadAttributesAndOptions($meal);
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


    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        if ($this->qty > 1)
            $this->qty--;
    }

    public function addToCart($slug, $product_qty, Coupon $coupon)
    {
        $meal = Meal::where('slug', $slug)->firstOrFail();
        $cart = new \App\Cart\Cart(new SessionStorage('cart'), $meal, $coupon);

        try {
            $cart->add($meal, $product_qty ?? 1);

            $this->cartItemCount = $cart->itemCount();

            notify()->success('Item added to cart successfully!');

            $this->emitTo('cart-count-component', 'refreshComponent');

        } catch (QuantityExceededException $e) {
            session()->flash('message', 'Quantity exceeded.');
            return redirect()->back();
        }

        flash('Item added to cart successfully!');
        return redirect()->back();
    }

    public function submitRating($slug)
    {
        if (!Auth::check()) {
            notify()->error('You need to log in to rate this meal.');

        }else {
            $userId = Auth::id();
            $meal = Meal::where('slug', $slug)->firstOrFail();

            $existingRating = Rating::where('user_id', $userId)
                ->where('meal_id', $meal->id)
                ->first();

            if ($existingRating) {

                notify()->error('You have already rated this meal.');


            } else {

                Rating::create([
                    'user_id' => $userId,
                    'meal_id' => $meal->id,
                    'rating' => $this->rating,
                    'comment' => $this->comment,
                ]);

                notify()->success('Rating submitted successfully!');
                $this->emit('ratingSubmitted', ['message' => 'Rating submitted successfully!', 'slug' => $slug]);
            }
        }
    }

    public function render()
    {
        $meal = Meal::where('slug', $this->slug)->first();
        $excludedIds = [$meal->id];

        $rproducts = Meal::where('category_id', $meal->category_id)
            ->whereNotIn('id', $excludedIds)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $nproducts = Meal::Latest()->take(4)->get();

        return view('livewire.details-component', ['meal' => $meal ,'rproducts' => $rproducts , 'nproducts' => $nproducts])->layout('layouts.font-layout');
    }
}
