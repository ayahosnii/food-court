<?php

namespace App\Helper;

use App\Http\Livewire\MealsComponent;

class CountItems
{
    public static function count()
    {
        $meals = new MealsComponent();
        return $meals->cartItemCount;
    }
}
