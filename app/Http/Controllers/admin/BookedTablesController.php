<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\providers\Provider;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookedTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = now()->format('Y-m');

        $reservations = Reservation::where('res_date', 'like', $currentMonth . '%')->get();

        return view('admin.booked-tables.index', compact('reservations'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function providers()
    {
        $providers = Provider::get();
        return view('admin.providers.index', compact('providers'));
    }

    public function providersReport($id)
    {
        $provider = Provider::where('id', $id)->first();
        $reservation = Reservation::where('provider_id', $id)->get();
        return view('admin.providers.reports', compact('reservation', 'provider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
