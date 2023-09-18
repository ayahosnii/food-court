<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Helper\MealCategorySorter;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchComponent extends BaseComponent
{
    public $q;
    public $search_term;



    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%' . $this->q . '%';

        $this->sorting = "price";
        $this->pagesize = "12";

        $this->min_price=1;
        $this->max_price=1000;

        $this->min_alphabet='a';
        $this->max_alphabet='z';
    }

    public function render()
    {
        $providers = Provider::where('accountactivated', '1')->get();
        $categories = Category::get();

        // Create a new instance of the meals query
        $mealsQuery = Meal::where('name', 'like' , $this->search_term);

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

        return view('livewire.search-component', [
            'providers' => $providers,
            'categories' => $categories,
            'meals' => $meals,
            'cartItemCount' => $this->cartItemCount,
            'favoriteMeals' => $this->favoriteMeals,
        ])->layout('layouts.font-layout');
    }
}
