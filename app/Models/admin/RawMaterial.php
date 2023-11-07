<?php

namespace App\Models\admin;

use App\Models\providers\Meal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{

    protected $fillable = [
        'name',
        'price',
        'unit',
        'calories',
        'brand',
        'weight'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_raw_material')
            ->withPivot('quantity');
    }

    // Define relationships


    public function inventory()
    {
        return $this->hasOne(RawMaterialInventory::class, 'raw_material_id');
    }

    // Define a relationship to the 'MealRawMaterial' model (for access to meals)
    public function mealRawMaterials()
    {
        return $this->hasMany(MealRawMaterial::class, 'raw_material_id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }

    // You can define other relationships, like orders or usage, if needed.

    // Additional methods can be added as needed for specific functionality.

    public function getTotalInventory()
    {
        return $this->inventory->quantity ?? 0;
    }

    public function getFormattedPrice()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getPricePerGram()
    {
        // Define a mapping of units to their multiplier to convert to grams
        $unitToGramMultiplier = [
            'grams' => 1,
            'kilograms' => 1000,
            'ounces' => 28.3495,
            'pounds' => 453.592,
            'milligrams' => 0.001,
            'micrograms' => 0.000001,
        ];

        // Convert the weight to grams
        $weightInGrams = $this->weight * ($unitToGramMultiplier[$this->unit] ?? 1);

        if ($weightInGrams <= 0) {
            return 0; // Prevent division by zero
        }

        return $this->price / $weightInGrams;
    }



    public function getPricePerGramAttribute()
    {
        $unitToGramMultiplier = [
            'grams' => 1,
            'kilograms' => 1000,
            'ounces' => 28.3495,
            'pounds' => 453.592,
            'milligrams' => 0.001,
            'micrograms' => 0.000001,
        ];

        // Convert the weight to grams
        $weightInGrams = $this->weight * ($unitToGramMultiplier[$this->unit] ?? 1);

        if ($weightInGrams <= 0) {
            return 0; // Prevent division by zero
        }

        return $this->price / $weightInGrams;
    }

}
