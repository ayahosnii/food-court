<?php

namespace App\Http\Controllers\providers;

use App\Http\Controllers\Controller;
use App\Models\providers\WhyChooseRestaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhyChooseRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chooses = WhyChooseRestaurant::where('provider_id', Auth::guard('providers')->id())->get();

        return view('providers.why-choose-restaurant.index', compact('chooses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.why-choose-restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingCount = WhyChooseRestaurant::where('provider_id', Auth::guard('providers')->id())->count();

        if ($existingCount >= 3){
            return redirect()->route('why-choose-restaurant.index')->with('error', 'You can only add up to 3 "Why Choose Our Restaurant" entries.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        WhyChooseRestaurant::create([
            'title' => $request->title,
            'description' => $request->description,
            'provider_id' => Auth::guard('providers')->id()
        ]);

        return redirect()->route('why-choose-restaurant.index')->with('success', 'Why Choose Our Restaurant added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
