<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\OptionsRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\admin\MainCategory;
use App\Models\Attribute;
/*use App\Models\Brand;
use App\Models\Image;*/
use App\Models\Option;
use App\Models\admin\Product;
/*use App\Models\Tag;*/

use App\Models\providers\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OptionController extends Controller
{

    public function index()
    {
        $options = Option::with(['meal' => function ($prod) {
            $prod->select('id');
        }, 'attribute' => function ($attr) {
            $attr->select('id');
        }])->select('id', 'meal_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

        return view('admin.options.index', compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['meals'] = Meal::published()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('admin.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {


        DB::beginTransaction();

        //validation
        $option = Option::create([
            'attribute_id' => $request->attribute_id,
            'meal_id' => $request->meal_id,
            'price' => $request->price,
        ]);
        //save translations
        $option->name = $request->name;
        $option->save();
        DB::commit();

        return redirect()->route('admin.options')->with(['success' => 'تم الاضافة بنجاح']);
    }

    public function edit($optionId)
    {

        $data = [];
        $data['option'] = Option::find($optionId);

        if (!$data['option'])
            return redirect()->route('admin.options')->with(['error' => 'هذه القيمة غير موجود ']);

        $data['meals'] = Meal::published()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('admin.options.edit', $data);

    }

    public function update($id, OptionsRequest $request)
    {
        try {

            $option = Option::find($id);

            if (!$option)
                return redirect()->route('admin.options')->with(['error' => 'هذا ألعنصر غير موجود']);

            $option->update($request->only(['price','meal_id','attribute_id']));
            //save translations
            $option->name = $request->name;
            $option->save();

            return redirect()->route('admin.options')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
