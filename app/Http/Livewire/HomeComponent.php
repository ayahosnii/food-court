<?php

namespace App\Http\Livewire;

use App\Cart\Cart;
use App\Exceptions\QuantityExceededException;
use App\Helper\CountItems;
use App\Models\admin\Banner;
use App\Models\admin\MainCategory;
use App\Models\admin\SubCategory;
use App\Models\Post;
use App\Models\providers\Category;
use App\Models\providers\Meal;
use App\Models\providers\Provider;
use App\Models\Sale;
use App\Services\SubscriptionService;
use App\Services\TimeService;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Http\Request as HttpRequest;

class HomeComponent extends BaseComponent
{
    public $days;
    public $hours;
    public $minutes;
    public $seconds;
    public $email;

    public function updateTimeValues($diff)
    {
        $timeValues = TimeService::updateTimeValues($diff);
        extract($timeValues);

        $this->days = $days;
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }



    public function subscribe()
    {
        if ($this->email == Auth::user()->email) {

            $result = (new SubscriptionService())->subscribeAndSendEmail($this->email, Auth::user()->id);

            if ($result == 'success') {
                session()->flash('success', 'You have successfully subscribed and received a coupon code!');
                $this->email = '';
            } else {
                session()->flash('error', 'Sorry, something went wrong while assigning the coupon code. Please try again later.');
            }
        } else {
            session()->flash('error', 'Sorry, you are not allowed to subscribe with this email address.');
        }
    }




    public function render()
    {
        $providers = Provider::where('accountactivated', '1')->get();
        $categories = Category::get();
        $meals = Meal::take(6)->get();

        $default_lang = get_default_language();

        $mainCategories = $this->loadCategories($default_lang);

        $data = $this->loadData();
        return view('livewire.home-component',$data, [
            'providers' => $providers,
            'categories' => $categories,
            'mainCategories' => $mainCategories,
            'meals' => $meals,
        ])->layout('layouts.font-layout');
    }

    private function loadData()
    {
        $default_lang = get_default_language();
        $data = [];

        $data['sub_categories'] = $this->loadSubCategories();
        $data['categories'] = $this->loadCategories($default_lang);
        $data['meals'] = $this->loadMeals();
        $data['lmeals'] = $this->loadLatestMeals();
        $data['smeals'] = $this->loadSpecialMeals();
        $data['posts'] = $this->loadLatestPosts();
        $data['sale'] = $this->loadLatestSale();
        $data['banners'] = Banner::get();

        $ends_at = null;

        if (isset($data['sale']->ends_at)) {
            $ends_at = Carbon::parse($data['sale']->ends_at);
        }

        $now = Carbon::now();
        $diff = $ends_at !== null ? $ends_at->diffInSeconds($now) : null;

        $this->updateTimeValues($diff);

        $data['ends_at'] = $ends_at;

        return $data;
    }


    private function loadSubCategories()
    {
        return SubCategory::parent()->select('id', 'slug')->with(['childeren' => function ($q) {
            $q->select('id', 'parent_id', 'slug');
            $q->with(['children' => function($qq) {
                $qq->with(['id', 'parent_id', 'slug']);
            }])->get();
        }]);
    }

    private function loadCategories($default_lang)
    {
        return MainCategory::where('translation_lang', $default_lang)->get();
    }

    private function loadMeals()
    {
        return Meal::where('published', '1')->limit('8')->get();
    }


    private function loadLatestMeals()
    {
        return Meal::orderBy('created_at','DESC')->where('published', '1')
            ->get()->take(8);
    }

    private function loadSpecialMeals()
    {
        return Meal::whereHas('sales', function ($query) {
            $query->where('percentage', '>', 0)
                ->where('ends_at', '>', now())
                ->where('published', '1');
        })->inRandomOrder()->take(8)->get();
    }


    private function loadLatestPosts()
    {
        return Post::latest()->with('user')->get();
    }

    private function loadLatestSale()
    {
        return Sale::latest()->first();
    }
}
