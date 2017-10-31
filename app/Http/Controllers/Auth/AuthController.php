<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Socialite;

use App\User;
use App\Socialprofile;

class AuthController extends Controller
{

    public function getSocialRedirect($provider) {

        return Socialite::with($provider)->redirect();
    
    }

    public function getSocialHandle($provider) {
            $user = Socialite::with($provider)->user();

            $socialUser = null;

            //Check is this email present
            $userCheck = User::where('email', '=', $user->email)->first();
            if(!empty($userCheck)) {
                $socialUser = $userCheck;
            } else {
                $sameSocialId = Socialprofile::where('social_id', '=', $user->id)->where('provider', '=', $provider )->first();

                if(empty($sameSocialId)) {
                    //There is no combination of this social id and provider, so create new one
                    $newSocialUser = new User;
                    $newSocialUser->email              = $user->email;
                    $newSocialUser->name = $user->name;
                    $newSocialUser->propic = $user->avatar;
                    // Generate random microtime string for password.
                    $newSocialUser->password = bcrypt($random_string = md5(microtime()));
                    $newSocialUser->save();

                    $socialprofile = new Socialprofile;
                    $socialprofile->user_id = $newSocialUser->id;
                    $socialprofile->provider= $provider;
                    $socialprofile->social_id = $user->id;
                    $socialprofile->profilepicurl = $user->avatar_original;
                    $socialprofile->save();
                    
                    $socialUser = $newSocialUser;
                } else {
                    //Load this existing social user
                    $socialUser = $sameSocialId->user;
                }

            }

            Auth::loginUsingId($socialUser->id);

            return redirect()->to('/');
    }
}
