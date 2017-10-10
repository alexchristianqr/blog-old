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
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }

    function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();

            //user exist
            if ($user) {

                $data = (new User)->where('id_provider', $user->getId())->first();

                if (!$data) {//new user
                    $authUser = $this->createUser($user, $provider);
                    Auth::login($authUser, true);
                    return redirect()->to('/cms/home');//user authenticated
                } else {//find user exist
                    switch ($data->state) {//validate type state
                        case 'I':
                            Auth::logout();
                            $msg = "El estado esta como INACTIVO, contácte al administrador.";
                            return redirect()->to('/login')->withErrors($msg);//user
                            break;
                        default:
                            Auth::login($data, true);
                            return redirect()->to('/cms/home');//user authenticated
                            break;
                    }
                }

            } else {
                $msg = "Driver Socialite no Authenticated.";
                return redirect()->to('/login')->withErrors($msg);
            }

        } catch (Exception $e) {
            self::fnDoLog('E', $e->getMessage());
            $this->fnFlashMessage('ADVERTENCIA', $e->getMessage(), 'warning');
            return redirect()->to('/login');
        }
    }

    private function createUser($user, $provider)
    {
        $avatar = str_replace('?sz=50', '', trim($user->getAvatar()));

        $new_user = (new User)->create([
            'name' => trim($user->getName()),
            'email' => trim($user->getEmail()),
            'avatar' => $avatar,
            'provider' => trim($provider),
            'id_provider' => trim($user->getId()),
        ]);
        return $new_user;//return nuevo usuario.
    }
}