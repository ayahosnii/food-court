<?php

namespace App\Helper;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Models\providers\Meal;
use App\Support\Storage\SessionStorage;

class CartHelper{

    public static function countItem()
    {
        if (!function_exists('cartItemCount')) {
            function cartItemCount()
            {
                $meal = Meal::get();
                $cart = new Cart(new SessionStorage('cart'), $meal);
                return $cart->itemCount();
            }
        }

    }
}
