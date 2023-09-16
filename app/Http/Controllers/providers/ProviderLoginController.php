<?php

namespace App\Http\Controllers\providers;

use App\Http\Controllers\Controller;
use App\Models\providers\ProviderLogin;
use App\Models\providers\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProviderLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $rules = [

                "provider-email"   => "required",
                "provider-password"       => "required",
            ];
            $messages = [
                "required"                          => trans("messages.required"),
            ];




            $this->validate($request, $rules , $messages);


            $email    =   $request->input('provider-email');
            $password =   $request->input('provider-password');


            $phone = Provider::find($request->id);
            $provider = DB::table('providers')->where('email', $email)
                ->where('password', $password)
                ->orwhere("phone", '0' . $phone)->first();


                if ($provider) {

                    $data = Provider::find($provider->id);

                    //save browser subscrbe token


                } else {

                    return redirect()->back()->with("provider-login-error", 'لم نجد أي سجلات للبيانات المدخلة');

                }
                    // login the user
                    Auth::guard('providers')->login($data);
                    return redirect("/providers/dashboard");



        } catch (\Exception $ex) {
            return $ex;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\providers\ProviderLogin  $providerLogin
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('providers')->logout();
        return redirect('/'); // You can redirect to any URL after logout.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\providers\ProviderLogin  $providerLogin
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderLogin $providerLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\providers\ProviderLogin  $providerLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderLogin $providerLogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\providers\ProviderLogin  $providerLogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderLogin $providerLogin)
    {
        //
    }
}
