<?php

namespace App\Http\Livewire;

use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{
    public function render()
    {
        $UserFavorites = UserFavorite::with('meal')
        ->where('user_id', Auth::user()->id)->get();
        return view('livewire.wishlist-component',
            ['UserFavorites' => $UserFavorites])->layout('layouts.font-layout');
    }
}
