<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\MealRawMaterial;
use App\Models\admin\RawMaterial;
use App\Models\admin\RawMaterialInventory;
use App\Models\providers\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RawMaterialController extends Controller
{
    public function index()
    {
        $rawMaterials = RawMaterial::with('inventory')->get();
        return view('admin.raw_material.index', compact('rawMaterials'));
    }

    public function addForMeal($id)
    {
        $meal = Meal::find($id);

        if (!$meal) {
            return redirect()->route('admin.raw_material')->with('error', 'Meal not found');
        }

        $rawMaterials = RawMaterial::all();
        return view('admin.raw_material.add_for_meal', compact('rawMaterials', 'meal'));
    }

    public function storeMealRawMaterial(Request $request)
    {
        $validatedData = $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'raw_material_id' => [
                'required',
                'exists:raw_materials,id',
                Rule::unique('meal_raw_material')->where(function ($query) use ($request) {
                    return $query->where('meal_id', $request->meal_id);
                })
            ],
            'quantity' => 'required|numeric',
            'unit' => 'required|in:grams,kilograms,ounces,pounds,milligrams,micrograms',
        ]);

        DB::beginTransaction();

        try {
            $mealRawMaterial = new MealRawMaterial();
            $mealRawMaterial->meal_id = $validatedData['meal_id'];
            $mealRawMaterial->raw_material_id = $validatedData['raw_material_id'];
            $mealRawMaterial->quantity = $validatedData['quantity'];
            $mealRawMaterial->unit = $validatedData['unit'];
            $mealRawMaterial->save();

            DB::commit();

            return redirect()->route('admin.materials.for.meal', $validatedData['meal_id'])->with('success', 'Meal raw material added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.materials.for.meal', $validatedData['meal_id'])->with('error', 'Failed to add meal raw material');
        }
    }

    public function create()
    {
        return view('admin.raw_material.create');
    }

    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate and store a new raw material
            $validatedData = $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
                'weight' => 'required|numeric',
                'unit' => 'required|string',
                'calories' => 'nullable|integer',
                'brand' => 'nullable|string',
            ]);

            $rawMaterial = RawMaterial::create($validatedData);

            // Insert the quantity into raw_material_inventory
            $quantityData = [
                'raw_material_id' => $rawMaterial->id,
                'quantity' => $request->input('quantity'), // Assuming you have an input field named 'quantity' in your form
            ];
            RawMaterialInventory::create($quantityData);

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('admin.materials')->with('success', 'Raw material created successfully');
        } catch (\Exception $e) {
            return $e;
            // Something went wrong, so rollback the transaction
            DB::rollback();

            // Handle the error, you can log or display an error message
            return redirect()->route('admin.materials')->with('error', 'Failed to create raw material');
        }
    }
    public function edit($id)
    {
        // Retrieve and display the raw material for editing
        $rawMaterial = RawMaterial::find($id);
        return view('admin.raw_material.edit', compact('rawMaterial'));
    }


    public function update(Request $request, $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate and update the raw material
            $validatedData = $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
                'unit' => 'required|string',
                'calories' => 'nullable|integer',
                'brand' => 'nullable|string',
            ]);

            $rawMaterial = RawMaterial::find($id);
            $rawMaterial->update($validatedData);

            // Update the quantity in raw_material_inventory
            $rawMaterialInventory = RawMaterialInventory::where('raw_material_id', $id)->first();
            $rawMaterialInventory->update([
                'quantity' => $request->input('quantity'), // Assuming you have an input field named 'quantity' in your form
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('raw_material.index')->with('success', 'Raw material updated successfully');
        } catch (\Exception $e) {
            // Something went wrong, so rollback the transaction
            DB::rollback();

            // Handle the error, you can log or display an error message
            return redirect()->route('raw_material.index')->with('error', 'Failed to update raw material');
        }
    }
    public function destroy($id)
    {
        // Delete a raw material and its associated inventory
        RawMaterial::destroy($id);
        RawMaterialInventory::where('raw_material_id', $id)->delete();

        return redirect()->route('raw_material.index')->with('success', 'Raw material deleted successfully');
    }
}
