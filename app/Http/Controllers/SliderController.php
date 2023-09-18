<?php

namespace App\Http\Controllers;

use App\Models\admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url|max:255',
        ]);

        $filePath = "";
        if ($request->has('background_image')) {
            $filePath = uploadImages('sliders', $request->photo);
        }

        // Create a new banner record in the database
        DB::beginTransaction();
        try {
            Slider::create([
                'background_image' => $filePath,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'link' => $request->input('link'),
            ]);

            DB::commit();

            // Redirect to a success page or return a response
            return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle the error, you can log the error or return an error response
            return redirect()->route('admin.banners.create')->with('error', 'Banner creation failed. Please try again.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
