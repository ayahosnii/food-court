<?php

namespace App\Cart;

use App\Exceptions\QuantityExceededException;
use App\Models\Coupon;
use App\Models\providers\Meal;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Support\Facades\Session;

class Cart
{
    /**
     * Instance of StorageInterface.
     *
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Instance of Meal.
     *
     * @var Meal
     */
    protected $meal;

    /**
     * Create a new Basket instance.
     *
     * @param StorageInterface $storage
     * @param Meal          $meal
     */
    public function __construct(StorageInterface $storage, Meal $meal, Coupon $coupon)
    {
        $this->storage = $storage;
        $this->meal = $meal;
        $this->coupon = $coupon;
    }

    /**
     * Calculate the price for a specific meal, taking into account any discounts.
     *
     * @param Meal $meal
     * @return float
     */
    protected function calculateMealPrice(Meal $meal)
    {
        $price = $meal->price;

        if ($meal->sales->isNotEmpty()) {
            return number_format($meal->price * (100 - $meal->sales->first()->percentage) / 100, 2);
        }


        return number_format($price, 2);
    }


    /**
     * Add the meal with its quantity to the basket.
     * The quantity will be updated if it exists.
     *
     * @param Meal  $meal
     * @param Integer  $quantity
     */
    public function add(Meal $meal, $quantity)
    {
        if ($this->has($meal)) {
            $quantity = $this->get($meal)['quantity'] + $quantity;
        }

        $this->update($meal, $quantity);
    }

    public function addCoupon(Coupon $coupon, $couponId = null)
    {
        $theCoupon = Coupon::where('id', $couponId)->first();
        if (!$this->checkCoupon($theCoupon)) {
            dd($couponId);
        }

        $theMeals = $coupon->meals;

        $selectedMeals = []; // Initialize an array to store selected meals

        foreach ($theMeals as $meal) {
            $selectedMeals[] = $meal; // Add each selected meal to the array
        }

        $currentCouponId = $selectedMeals[0]->pivot->coupon_id; // Assuming you want to use the first meal's coupon ID

        $couponId = $couponId !== null ? $couponId : $currentCouponId;

        // Loop through selected meals and update them with the same coupon ID and quantity from the session
        foreach ($selectedMeals as $meal) {
            $mealData = $this->get($meal);

            // Check if $mealData is null before accessing its properties
            if ($mealData !== null) {
                $quantity = isset($mealData['quantity']) ? $mealData['quantity'] : 0; // Get quantity from the session
                $mealPrice = $this->calculateMealPrice($meal);
                // Calculate the updated price based on the applied coupon
                $updatedPrice = $mealPrice * $quantity;
                if ($coupon) {
                    if ($coupon->type === 'fixed') {
                        $updatedPrice -= $coupon->value;
                    } elseif ($coupon->type === 'percent') {
                        $updatedPrice -= ($coupon->value / 100) * $updatedPrice;
                    }
                }

                $this->storage->set($mealData['meal_id'], [
                    'meal_id' => (int) $mealData['meal_id'],
                    'quantity' => (int) $quantity,
                    'coupon' => $couponId,
                    'newPrice' => $updatedPrice, // Add 'newPrice' key with the updated price
                ]);
            }
        }

        return true;
    }

    public function checkCoupon(Coupon $coupon)
    {
        foreach ($coupon->meals as $meal){
            if ($this->has($meal)) {
                return true;
            }
        }


//        if (!$coupon->active || !$coupon->isValid() || ($this->get($coupon->meal)['quantity'] < $coupon->meals_count)) {
//            return false;
//        }
//
//        if ($coupon->members()->find(auth()->guard('site')->id())) {
//            return false;
//        }

        return false;
    }

    public function checkCouponById($id)
    {
        $coupon = Coupon::find($id);

        if(!$coupon){
            return false;
        }

        return $this->checkCoupon($coupon);
    }

    /**
     * Update the basket.
     *
     * @param Meal $meal
     * @param         $quantity
     *
     * @throws QuantityExceededException
     */
    public function update(Meal $meal, $quantity)
    {
        /*if (! $this->meal->find($meal->id)->hasStock($quantity)) {
            throw new QuantityExceededException;
        }*/

        if ($quantity == 0) {
            $this->remove($meal);
            return;
        }

        $mealData = $this->get($meal);

        $this->storage->set($mealData['meal_id'] ?? $meal->id, [
            'meal_id' => (int) ($mealData['meal_id'] ?? $meal->id),
            'quantity' => (int) $quantity,
            'coupon' => $mealData['coupon'] ?? null,
            'newPrice' => $mealData['newPrice'] ?? null,
        ]);
    }

    public function updateQty(Meal $meal, $quantity)
    {
        /*if (! $this->meal->find($meal->id)->hasStock($quantity)) {
            throw new QuantityExceededException;
        }*/

        if ($quantity == 0) {
            $this->remove($meal);
            return;
        }

        $mealData = $this->get($meal);

        $this->storage->set($mealData['meal_id'] ?? $meal->id, [
            'meal_id' => (int) ($mealData['meal_id'] ?? $meal->id),
            'quantity' => (int) $quantity,
            'coupon' => $mealData['coupon'] ?? null,
            'newPrice' => $mealData['newPrice'] ?? null,
        ]);

        return $mealData['quantity'];
    }


    /**
     * Remove a Meal from the storage.
     *
     * @param  Meal $meal
     */
    public function remove(Meal $meal)
    {
        try {
            $this->storage->remove($meal->id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if the basket has a certain meal.
     *
     * @param  Meal $meal
     */
    public function has(Meal $meal)
    {
        return $this->storage->exists($meal->id);
    }

    /**
     * Get a meal that is inside the basket.
     *
     * @param  Meal $meal
     */
    public function get(Meal $meal)
    {
        return $this->storage->get($meal->id);
    }

    /**
     * Clear the basket.
     */
    public function clear()
    {
        return $this->storage->clear();
    }

    /**
     * Get all meals inside the basket.
     */
    public function all()
    {
        $ids = [];
        $items = [];

        foreach ($this->storage->all() as $meal) {
            $ids[] = $meal['meal_id'];
        }

        $meals = $this->meal->find($ids);


        foreach ($meals as $meal) {
            $meal->quantity = $this->get($meal)['quantity'];
            $meal->coupon = $this->get($meal)['coupon'];
            $meal->newPrice = $this->get($meal)['newPrice'];
            $items[] = $meal;
        }

        return $items;
    }

    /**
     * Get the amount of meals inside the basket.
     */
    public function itemCount()
    {
        return count($this->storage->all());
    }

    /**
     * Get the subtotal price of all meals inside the basket.
     */
    public function subTotal()
    {
        $subtotal = 0;

        foreach ($this->all() as $item) {
            $mealPrice = $this->calculateMealPrice($item);

//            if ($item->outOfStock()) {
//                continue;
//            }

            $subtotal += $mealPrice * $item->quantity;;
        }

        return floatval(number_format($subtotal, 2));
    }


    public function totalPriceAfterDiscount()
    {
        $totalPriceAfterDiscount = 0;

        foreach ($this->all() as $item) {
            $coupon = \App\Models\Coupon::find($item->coupon);
            $mealPrice = $this->calculateMealPrice($item);

            if ($coupon) {
                if ($coupon->type === 'fixed') {
                    $discountedPrice = $mealPrice * $item->quantity - $coupon->value;
                } elseif ($coupon->type === 'percent') {
                    $discountedPrice = $mealPrice * $item->quantity - ($coupon->value / 100) * ($mealPrice * $item->quantity);
                }
            } else {
                $discountedPrice = $mealPrice * $item->quantity;
            }

            $totalPriceAfterDiscount += $discountedPrice;
        }

        return number_format($totalPriceAfterDiscount, 2);
    }

    public function calculateTotalDiscount()
    {
        $totalDiscount = 0;

        foreach ($this->all() as $item) {
            $coupon = \App\Models\Coupon::find($item->coupon);
            $mealPrice = $this->calculateMealPrice($item);

            if ($coupon) {
                if ($coupon->type === 'fixed') {
                    $totalDiscount += $coupon->value;
                } elseif ($coupon->type === 'percent') {
                    $totalDiscount += ($coupon->value / 100) * ($mealPrice * $item->quantity);
                }
            }
        }

        return number_format($totalDiscount, 2);
    }




    /**
     * Check if the items in the basket are still in stock.
     */
    public function refresh()
    {
        foreach ($this->all() as $item) {
            if (! $item->hasStock($item->quantity)) {
                $this->update($item, $item->stock);
            }
        }
    }
    public static function aya()
    {
        return 'aya';
    }
}
