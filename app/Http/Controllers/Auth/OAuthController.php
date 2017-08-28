<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 10/08/2017
 * Time: 06:18 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Utility;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class OAuthController
{
    use Utility;

    function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            $this->fnFlashMessage('ERROR', $e->getMessage(), 'danger');
            return redirect()->route('login')->withErrors('message de error');
        }
    }

    function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();

            // stroing data to our use table and logging them in
            if ($user) {
                $authUser = $this->findOrCreateUser($user, $provider);
                Auth::login($authUser, true);
                return redirect()->route('login');
            } else {
                $this->fnFlashMessage('ERROR', 'ah ocurrido un error', 'danger');
                return redirect()->route('user.login');
            }

        } catch (Exception $e) {
            self::fnDoLog('I',$e->getMessage());
            $this->fnFlashMessage('ADVERTENCIA', $e->getMessage(), 'warning');
            return redirect()->route('login');
        }
    }

    private function findOrCreateUser($user, $provider)
    {
        $found = (new User)->where('provider_id', $user->getId())->where('state', 'A')->first();
        if ($found) {
            return $found;
        }

        $avatar = str_replace('?sz=50', '', trim($user->getAvatar()));

        $new_user = (new User)->create([
            'name' => trim($user->getName()),
            'email' => trim($user->getEmail()),
            'avatar' => $avatar,
            'provider' => trim($provider),
            'provider_id' => trim($user->getId()),
        ]);
        return $new_user;
    }
}