<?php

namespace App\Helper;

use App\Models\admin\MainCategory;
use App\Models\providers\Meal;
use App\Models\providers\MealTranslation;

class MealCategorySorter
{
    public static function filterByCategory($mealsQuery, $categoryInputs)
    {
        $default_lang = get_default_language();

        if ($categoryInputs) {
            if ($default_lang == 'en') {
                $mealsQuery->whereIn('main_cate_id', $categoryInputs);
            } else {
                $mealsQuery->whereIn('arabic_main_category_id', $categoryInputs);

            }
        }

        return $mealsQuery;
    }

}
