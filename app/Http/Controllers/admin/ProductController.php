<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\MainCategory;
use App\Models\admin\Product;
use App\Models\admin\ProductTranslation;
use App\Models\providers\Meal;
use App\Models\providers\MealTranslation;
use App\Models\providers\Provider;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_lang = get_default_language();
        $products = Meal::select()->get();
        return view('admin.products.index', compact('products'));
    }

    public function report($id)
    {
        try {
            $meal = Meal::find($id);
            if (!$meal)
                return redirect()->route('admin.meals')->with(['error' => 'هذا المنتج غير موجود']);
            $meal = Meal::with('rawMaterials')->find($id);
            $orderItemCount = $meal->getOrderItemCount($id);
            $totalPriceForMeal = $meal->getTotalPriceForMeal($id);
            $averageRating = $meal->ratings->avg('rating');
            $currentYear = date('Y');

            $averageRatingCurrentYear = $meal->ratings()
                ->whereYear('created_at', $currentYear)
                ->avg('rating');

            return view('admin.products.report', compact('meal', 'averageRatingCurrentYear', 'orderItemCount', 'totalPriceForMeal', 'averageRating'));


        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.meals')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }


    public function generatePDF($id)
    {
        try {
            $meal = Meal::find($id);
            if (!$meal)
                return redirect()->route('admin.meals')->with(['error' => 'هذا المنتج غير موجود']);
            $meal = Meal::with('rawMaterials')->find($id);
            $orderItemCount = $meal->getOrderItemCount($id);
            $totalPriceForMeal = $meal->getTotalPriceForMeal($id);
            $averageRating = $meal->ratings->avg('rating');
            $currentYear = date('Y');

            $averageRatingCurrentYear = $meal->ratings()
                ->whereYear('created_at', $currentYear)
                ->avg('rating');

            $pdf = PDF::loadView('admin.products.report', compact('meal', 'averageRatingCurrentYear', 'orderItemCount', 'totalPriceForMeal', 'averageRating'));
            return $pdf->download('meal-report.pdf');

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.meals')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MainCategory::active()->get();
        $providers = Provider::AccountActivated()->get();
        return view('admin.products.create', compact('categories', 'providers'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if (!$request->has('featured'))
                $request->request->add(['featured' => 0]);
            else
                $request->request->add(['featured' => 1]);

            $filePath = "";
            if ($request->has('image')) {
                $filePath = uploadImages('meals', $request->image);
            }
/**/

            DB::beginTransaction();

            $meal = Meal::create([
                'name' => $request->input("name_en"),
                'description' => $request->input("description_en"),
                'slug' => Str::slug($request->input("name_en")),
                'price' => $request->price,
                'calories' => $request->calories,
                'provider_id' => (int)$request->provider_id,
                'in_stock' => $request->stock_status,
                'category_id' => 1,
                'main_cate_id' => $request->main_cate_id,
                'published' => 1,
                'image' => $filePath,
            ]);
            //save translations
            foreach (get_languages() as $lang) {
                $translation = MealTranslation::firstOrNew([
                    'meal_id' => $meal->id,
                    'locale' => $lang->abbr,
                ]);
                $translation->name = $request->input("name_$lang->abbr");
                $translation->description = $request->input("description_$lang->abbr");
                $translation->save();
            }


            DB::commit();
            return redirect() -> route('admin.products')->with(['success' => 'تم الحفظ بنجاح']);
        }catch (\Exception $ex) {
            DB::rollback();
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getStock($meal_id){


        return view('admin.products.stock') -> with('id',$meal_id) ;
    }
    public function saveProductStock (ProductStockRequest $request){


        Meal::whereId($request -> meal_id) -> update($request -> except(['_token','meal_id']));

        return redirect()->route('admin.meals')->with(['success' => 'تم التحديث بنجاح']);

    }
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function changeStatus($id)
    {
        try {
            $product = Meal::find($id);
            if (!$product)
                return redirect()->route('admin.meals')->with(['error' => 'هذا المنتج غير موجود']);

            $status = $product->published == '0' ? '1' : '0';

            $product->update(['published' => $status]);
            return redirect()->route('admin.meals')->with(['success' => 'تم تغيير حالة المنتج بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.meals')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function acceptMeals()
    {
        $meals = Meal::where('published', '0')->get();
        return view('admin.products.accept', compact('meals'));
    }
}
