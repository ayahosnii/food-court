<?php

namespace App\Models\providers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseRestaurant extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image_url'];

}
