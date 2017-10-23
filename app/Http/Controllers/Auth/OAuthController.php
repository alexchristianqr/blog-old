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
use Illuminate\Http\Request;
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
            return redirect()->to('/login')->withErrors($e->getMessage());
        }
    }

    function handleProviderCallback($provider, Request $request)
    {
        try {
            $user = Socialite::driver($provider)->user();

            // Driver Exist
            if ($user) {

                $data_user = (new User)->where('id_provider', $user->getId())->first();

                // Validate Exist User
                if (!$data_user) {
                    return $this->redirectRegisterUser($user, $provider);
                } else {

                    // Validate Status
                    switch ($data_user->status) {
                        case 'I':
                            $request->session()->regenerate();
                            Auth::logout();
                            return redirect()->to('/login')->withErrors('Your session has expired because your account is deactivated.');//user
                            break;
                        default:

                            $request->session()->regenerate();

                            $data_type_user = (new User)
                                ->join('type_user', 'type_user.id', '=', 'users.id_type_user')
                                ->where('users.id_type_user', $data_user->id_type_user)
                                ->first(['type_user.id', 'type_user.name', 'type_user.roles']);

                            if (count(json_decode($data_type_user->roles))) {
                                $rols = $data_type_user->roles;
                            } else {
                                $rols = '{}';
                            }
                            $session_roles = json_decode($rols);

                            // Create Sessions
                            session(['session_roles' => $session_roles]);
                            session(['session_type_user' => $data_type_user]);

                            // Session Super-Administrator
                            if ($data_type_user->id === 1) session(['super_administrator' => true]);

                            Auth::login($data_user, true);
                            return redirect()->to('/cms/home');//user authenticated
                            break;
                    }
                }

            } else {
                $msg = "Driver socialite not executed.";
                return redirect()->to('/login')->withInput()->withErrors($msg);
            }

        } catch (Exception $e) {
            self::fnDoLog('E', $e->getMessage());
            return redirect()->to('/login')->withInput()->withErrors($e->getMessage());
        }
    }

    private function redirectRegisterUser($user, $provider)
    {

        $array = explode(" ", $user->name);
        $rename = [];
        $alias = "";

        if (count($array))
            try {
                if (count($array) == 1) {
                    $rename[0] = $array[0];
                    $rename[1] = $array[0];
                    $alias = $array[0];

                }elseif (count($array) == 2) {
                    $rename[0] = $array[0];
                    $rename[1] = $array[1];
                    $alias = $array[0] . $array[1];

                } elseif(count($array) == 3) {
                    $rename[0] = $array[0];
                    $rename[1] = $array[1] . ' ' . $array[2];
                    $alias = $array[0] . $array[1];

                } else {
                    $rename[0] = $array[0] . ' ' . $array[1];
                    $rename[1] = $array[2] . ' ' . $array[3];
                    $alias = $array[0] . $array[2];
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

        $data = (object)[
            'username' => trim(strtolower($user->name)),
            'name' => trim(strtolower($rename[0])),
            'lastname' => trim(strtolower($rename[1])),
            'nick' => trim(strtolower($alias)),
            'email' => trim($user->email),
            'avatar' => isset($user->avatar_original)?$user->avatar_original:$user->avatar,
            'provider' => trim($provider),
            'id_provider' => trim($user->id),
        ];

        return redirect()->to('/socialite/register')->with('data', $data);
    }

}