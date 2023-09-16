<?php

namespace App\Http\Controllers\providers;

use App\Http\Controllers\Apis\User\GeneralController;
use App\Http\Controllers\Apis\User\SmsController;
use App\Http\Controllers\Controller;
use App\Http\Requests\providers\ProviderRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\providers\Provider;
use Twilio\Rest\Client;

class ProviderController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        try {
//
//        $code = (new GeneralController())->generate_random_number(4);
//        $token = (new GeneralController())->get_token(128);
//
//
//        $hash = json_encode([
//            'code' => $code,
//            'type' => 'phone-activation',
//            'expiry' => Carbon::now()->addDay(1)->timestamp,
//        ]);
//
//        $message = " رقم الدخول الخاص بك هو :- " .$code;
//        #$res = (new SmsController())->send($message, $request->input("phone"));

            $code = rand(1000, 9999);
            $token = (new GeneralController())->get_token(128);


            $hash = json_encode([
                'code' => $code,
                'type' => 'phone-activation',
                'expiry' => Carbon::now()->addDay(1)->timestamp,
            ]);


            $data = [];
            if ($request->hasFile("rest_img")) {
                $request->rest_img->store('providers-logo', 'public');
                $img_id = DB::table("provider_registers")->insertGetId([
                    "name" => $request->rest_img->hashName()
                ]);

                $data['images'] = $img_id;
            }

            $data = \App\Models\providers\Provider::create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->mobile,
                /* 'province_id'             => $request->province,
                 'city_id'                   => $request->city,*/
                'address' => $request->address,
                'password' => Hash::make($request->password),
                "ar_details" => $request->ar_details,
                "en_details" => $request->en_details,
                "logo" => $request->rest_img,
                'activate_phone_hash' => $hash,
                'token' => $token
            ]);

            /* $id = DB::table("provider_registers")
                 ->insertGetId($data);*/
//
//            DB::table('role_user_lara') -> insert([
//
//                'role_id'     => 2,
//                'user_id'    => $data->id,
//                'user_type'  => 'provider',
//
//            ]);

            Auth::guard('providers')->login(Provider::find($data->id));
//
//            return response()->json([
//                "status" => true,
//                "errNum" => 0,
//                "msg"    => $msg[12],
//                "token"  => $token,
//            ]);

            if (auth('providers')->check()) {
                $code = rand(1000, 9999);

                // Send a verification code via Twilio
                $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
                $twilio->messages->create(auth('providers')->user()->phone, [
                    "from" => env('TWILIO_PHONE_NUMBER'),
                    "body" => "Your verification code is: " . $code
                ]);

                // Store the verification code in the database
                Provider::where('id', auth('providers')->id())->update([
                    "activate_phone_hash" => json_encode(["code" => $code])
                ]);

                return redirect()->route('home');
            } else {
                // Redirect the user to the login page or display an error message
                return redirect('providers/login')->with('error', 'Please login first');
            }
        } catch (Exception $exception){
            return $exception;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $Provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $Provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $Provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $Provider)
    {
        //
    }
}
