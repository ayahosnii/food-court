<?php

namespace App\Models;

use App\Models\admin\Product;
use App\Models\providers\Meal;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Option extends Model implements TranslatableContract
{

    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute_id', 'meal_id','price'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function attribute(){
        return $this -> belongsTo(Attribute::class,'attribute_id');
    }
}

