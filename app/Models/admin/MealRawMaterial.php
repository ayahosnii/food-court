<?php

namespace App\Models\admin;

use App\Models\providers\Meal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealRawMaterial extends Model
{
    protected $table = 'meal_raw_material';
    protected $guarded = [];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }

    public function inventory()
    {
        return $this->rawMaterial->inventory;
    }
}
