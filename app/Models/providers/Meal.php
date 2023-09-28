<?php

namespace App\Models\providers;

use App\Models\admin\MainCategory;
use App\Models\Coupon;
use App\Models\Option;
use App\Models\providers\Provider;
use App\Models\Rating;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Auth;

class Meal extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $guarded = [];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];


    public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
    public function getActive()
    {
        return $this->published == 0 ? 'inactive' : 'active';
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class,'maincate_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id',  'id');
    }

    public function getImageAttribute($val)
    {
        return ($val !== null) ? asset('provider-assets/images/meals/' . $val) : "";

    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites', 'meal_id', 'user_id');
    }


    public function sales()
    {
        return $this->belongsToMany(Sale::class)
            ->where('ends_at', '>=', now());
    }


    public function scopeSortBy($query, $sorting, $pageSize)
    {
        switch ($sorting) {
            case 'date':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'price':
                $query->orderBy('price', 'ASC');
                break;
            case 'price-desc':
                $query->orderBy('price', 'DESC');
                break;
            case 'alphabet':
                $query->orderBy('name', 'ASC');
                break;
            case 'alphabet-desc':
                $query->orderBy('name', 'DESC');
                break;
            default:
                $query->orderBy('created_at', 'ASC');
                break;
        }

        return $query;
    }

    // Meal.php (assuming you have this relationship)
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopePublished($query){
        return $query ->where('published', 1);
    }

    public function isInFavorites()
    {
        $user = Auth::user();

        if ($user) {
            return $user->favoriteMeals->contains($this);
        }

        return false;
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_meal');
    }
//
//    public function hasStock($quantity)
//    {
//        return $this->qty >= $quantity;
//    }
//
//    public function outOfStock()
//    {
//        return $this->qty === 0;
//    }
//
//    public function inStock()
//    {
//        return $this->qty >= 1;
//    }

}
