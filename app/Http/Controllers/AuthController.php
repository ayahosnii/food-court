<?php

namespace App\Http\Controllers;

use App\Models\providers\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function get_activate_phone(){


        if (!auth('providers')->check()) {
            return redirect('/login');
        }

        if (auth('providers')->user()->phoneactivated == "1"){
            return redirect('/providers/dashboard');
        }




        $data['title'] = "تأكيد رقم الهاتف";
        $data['class'] = "page-template password recovery";


        return view("auth.verification-code", $data);

    }

    public function store_verification_code(Request $request)
    {
        $rules = ["code" => "required"];
        $messages = [
            "required" => trans("messages.required"),
        ];
        $this->validate($request, $rules, $messages);
        $code = $request->code;
        $hash = json_decode(auth('providers')->user()->activate_phone_hash);

        if ($hash->code != $code){
            return redirect()->back()->with("error", trans("messages.register.active.notMatch"));
        }

        Provider::where('id', auth('providers')->id())->update([
            "phoneactivated" => "1",
            "activate_phone_hash" => ""
        ]);
//
//        DB::table("provider_registers")
//            ->where("id", auth('providers'))
//            ->where("id", auth('providers')->id())
//            ->update([
//                "phoneactivated" => "1",
//                "activate_phone_hash" => ""
//            ]);

        return redirect()->back();

    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirectUrl('https://food-court.ayahosni.com/')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
        $user = Socialite::driver('facebook')->user();

        // Check if the user already exists in your application's database
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // If the user already exists, log them in and redirect them to the dashboard
            Auth::login($existingUser);

            return redirect('/');
        }

        // If the user does not exist, create a new user record in your application's database
        $newUser = new User;
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->password = bcrypt(Str::random(16));
        $newUser->save();

        // Log in the new user and redirect them to the dashboard
        Auth::login($newUser);

        return redirect('/');
        } catch (\Exception $e) {
            // Log or handle the exception
            Log::error('Error during Facebook authentication: ' . $e->getMessage());
            return $e;
        }
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Check if the user already exists in your application's database
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // If the user already exists, log them in and redirect them to the dashboard
            Auth::login($existingUser);

            return redirect('/');
        }

        // If the user does not exist, create a new user record in your application's database
        $newUser = new User;
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->password = bcrypt(Str::random(16));
        $newUser->save();

        // Log in the new user and redirect them to the dashboard
        Auth::login($newUser);

        return redirect('/');
    }


}
