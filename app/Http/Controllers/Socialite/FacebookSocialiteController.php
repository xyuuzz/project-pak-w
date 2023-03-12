<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookSocialiteController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('social_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect()->route("index-page");
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'facebook',
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect()->route("index-page");
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
