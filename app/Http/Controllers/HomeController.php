<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmsRequest;
use App\Http\Services\cmsService;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    function personalService()
    {
        $Post = new PostService();
        $rpta = $Post->getMiniPosts();
        $rpta2 = $Post->getPrePosts();
        if ($rpta['load'] && $rpta2['load']) {
            $data_mini_posts = $rpta['data'];
            $data_pre_posts = $rpta2['data'];
            return view('service', compact('data_mini_posts', 'data_pre_posts'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function personalProfile()
    {
        $Post = new PostService();
        $rpta = $Post->getMiniPosts();
        $rpta2 = $Post->getPrePosts();
        if ($rpta['load'] && $rpta2['load']) {
            $data_mini_posts = $rpta['data'];
            $data_pre_posts = $rpta2['data'];
            return view('profile', compact('data_mini_posts', 'data_pre_posts'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function personalPortfolio()
    {
        $data = DB::table('portfolio')->where('status', 'A')->get();
        if ($data) {
            return view('portfolio', compact('data'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function personalContact()
    {
        $Post = new PostService();
        $rpta = $Post->getMiniPosts();
        $rpta2 = $Post->getPrePosts();
        if ($rpta['load'] && $rpta2['load']) {
            $data_mini_posts = $rpta['data'];
            $data_pre_posts = $rpta2['data'];
            return view('contact', compact('data_mini_posts', 'data_pre_posts'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function socialiteRegister(Request $request)
    {
        $data = $request->session()->get('data');
        session(['temp_data_socialite' => $data]);
        return view('auth.register', compact('data'));
    }

    function socialiteStore(CmsRequest $request)
    {
//        dd($request);
        //for Store
        if ($request->password === $request->confirm_password) {
            $request->request->add(['id_type_user' => 4]);
            $request->request->add(['status' => 'I']);

            if ($request->id_type_user == 4) {
                $rpta = (new CmsService())->storeUser($request);
                if ($rpta['load']) {
                    $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
                    return redirect()->to('/login');
                } else {
                    return redirect()->back()->withInput()->withErrors($rpta['message']);
                }
            } else {
                return redirect()->to('/login');
            }

        } else {
            return redirect()->back()->withInput()->withErrors('Las contraseñas ingresadas son incorrectas.');
        }

    }

}