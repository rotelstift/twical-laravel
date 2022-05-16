<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class TwitterLoginController extends Controller
{
    /**
     * Redirect to Twitter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Handler of Twitter Callback
     *
     * @return url
     */
    public function handleTwitterCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            $user = User::where('twitter_id', $twitterUser->id)->first();

            if (empty($user)) {
                $user = User::create([
                    'name' => $twitterUser->name,
                    'twitter_id' => $twitterUser->id,
                ]);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }

        Auth::login($user);

        return redirect('/');
    }
}
