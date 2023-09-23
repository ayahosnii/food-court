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
    protected $product;

    /**
     * Create a new Basket instance.
     *
     * @param StorageInterface $storage
     * @param Meal          $product
     */
    public function __construct(StorageInterface $storage, Meal $product, Coupon $coupon)
    {
        $this->storage = $storage;
        $this->product = $product;
        $this->coupon = $coupon;
    }

    /**
     * Add the product with its quantity to the basket.
     * The quantity will be updated if it exists.
     *
     * @param Meal  $product
     * @param Integer  $quantity
     */
    public function add(Meal $product, $quantity)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product, $quantity);
    }

    public function addCoupon(Coupon $coupon, $couponId = null)
    {
        $theCoupon = Coupon::where('id', $couponId)->first();
        if (!$this->checkCoupon($theCoupon)) {
            dd($couponId);
        }

        $theMeals = $coupon->meals;

        $selectedMeal = null;

        foreach ($theMeals as $meal) {
                $selectedMeal = $meal;
        }


        $currentCouponId = $selectedMeal->pivot->coupon_id;


        $meal = $this->get($selectedMeal);


        $couponId = $couponId !== null ? $couponId : $currentCouponId;
        $this->storage->set($meal['product_id'], [
            'product_id' => (int) $meal['product_id'],
            'quantity' => $meal['quantity'],
            'coupon' => $couponId,
        ]);
        return true;
    }

    public function checkCoupon(Coupon $coupon)
    {
        foreach ($coupon->meals as $meal){
            if ($this->has($meal)) {
                return true;
            }
        }


//        if (!$coupon->active || !$coupon->isValid() || ($this->get($coupon->product)['quantity'] < $coupon->products_count)) {
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
     * @param Meal $product
     * @param         $quantity
     *
     * @throws QuantityExceededException
     */
    public function update(Meal $product, $quantity)
    {
        /*if (! $this->product->find($product->id)->hasStock($quantity)) {
            throw new QuantityExceededException;
        }*/

        if ($quantity == 0) {
            $this->remove($product);

            return;
        }

        if ($this->has($product)) {
            $coupon = $this->get($product)['coupon'];
        }else{
            $coupon = null;
        }

        $this->storage->set($product->id, [
            'product_id' => (int) $product->id,
            'quantity' => (int) $quantity,
            'coupon' => $coupon,
        ]);
    }

    /**
     * Remove a Meal from the storage.
     *
     * @param  Meal $product
     */
    public function remove(Meal $product)
    {
        try {
            $this->storage->remove($product->id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if the basket has a certain product.
     *
     * @param  Meal $product
     */
    public function has(Meal $product)
    {
        return $this->storage->exists($product->id);
    }

    /**
     * Get a product that is inside the basket.
     *
     * @param  Meal $product
     */
    public function get(Meal $product)
    {
        return $this->storage->get($product->id);
    }

    /**
     * Clear the basket.
     */
    public function clear()
    {
        return $this->storage->clear();
    }

    /**
     * Get all products inside the basket.
     */
    public function all()
    {
        $ids = [];
        $items = [];

        foreach ($this->storage->all() as $product) {
            $ids[] = $product['product_id'];
        }

        $products = $this->product->find($ids);


        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
            $product->coupon = $this->get($product)['coupon'];
            $items[] = $product;
        }

        return $items;
    }

    /**
     * Get the amount of products inside the basket.
     */
    public function itemCount()
    {
        return count($this->storage->all());
    }

    /**
     * Get the subtotal price of all products inside the basket.
     */
    public function subTotal()
    {
        $subtotal = 0;

        foreach ($this->all() as $item) {
//            if ($item->outOfStock()) {
//                continue;
//            }

            $subtotal += $item->price * $item->quantity;;
        }

        return floatval(number_format($subtotal, 2));
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
