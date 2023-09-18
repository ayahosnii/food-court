<?php

namespace App\Http\Livewire;

use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCountComponent extends Component
{
    public $wishlistCount;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        if (Auth::check()) {
            $this->wishlistCount = UserFavorite::where('user_id', Auth::user()->id)->count() ?? 0;
        } else {
            $this->wishlistCount = 0; // Set a default value if the user is not authenticated.
        }
        return view('livewire.wishlist-count-component');
    }
}
