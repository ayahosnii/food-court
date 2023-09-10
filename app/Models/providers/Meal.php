<?php

namespace App\Models\providers;

use App\Models\admin\MainCategory;
use App\Models\ProviderRegister;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Meal extends Model /*implements TranslatableContract*/
{
    public $table = "meals";
//    use Translatable;

//    public $translatedAttributes = ['ar_name',	'ar_details'];
    public $fillable = ['id','name','slug','image','subcate_id',	'description',	'calories',	'category_id', 'main_cate_id',	'branch_id',
        'price',	'published','providers_id ','provider_id',	'created_at',	'updated_at'];

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
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



}
