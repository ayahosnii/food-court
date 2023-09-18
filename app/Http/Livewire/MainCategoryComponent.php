<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Helper\MealCategorySorter;
use App\Models\admin\MainCategory;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MainCategoryComponent extends BaseComponent
{
    public function mount($slug)
    {
        $this->slug = $slug;

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
        $mainCategory = MainCategory::where('slug',  $this->slug)->first();
        // Create a new instance of the meals query
        $mealsQuery = Meal::where('main_cate_id', $mainCategory->id);
        $default_lang = get_default_language();

        $mainCategoryId = $mainCategory->id;
        $mealsQuery = Meal::where(function ($query) use ($mainCategoryId) {
            $query->where('main_cate_id', $mainCategoryId);

            $default_lang = get_default_language();
            if ($default_lang != 'en') {
                $query->orWhere('arabic_main_category_id', $mainCategoryId);
            }
        });


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

        return  view('livewire.main-category-component', [
            'providers' => $providers,
            'categories' => $categories,
            'meals' => $meals,
            'mainCategory' => $mainCategory,
            'cartItemCount' => $this->cartItemCount,
            'favoriteMeals' => $this->favoriteMeals,
        ])->layout('layouts.font-layout');
    }


}
