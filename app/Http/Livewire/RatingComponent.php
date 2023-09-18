<?php

namespace App\Http\Livewire;

use App\Models\providers\Meal;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RatingComponent extends Component
{
    public $rating = 0;
    public $comment;
    public $slug;



    protected $listeners = ['ratingSubmitted' => 'handleRatingSubmitted'];

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function handleRatingSubmitted($data)
    {
        $message = $data['message'];
        $slug = $data['slug'];

        // Fetch and update the rating and comment for the specified meal
        $meal = Meal::where('slug', $slug)->first();
        $latestRating = $meal->ratings()->latest()->first();

        if ($latestRating) {
            $this->rating = $latestRating->rating;
            $this->comment = $latestRating->comment;
        } else {
            $this->rating = 0;
            $this->comment = '';
        }
    }


    public function render()
    {
        $ratings = Rating::get();
        return view('livewire.rating-component', ['ratings' => $ratings]);
    }
}
