<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmsRequest;
use App\Http\Services\cmsService;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct(PostService $postService)
    {
        $this->middleware(['web'])->except('logout');
        $this->service = $postService;
    }

    function personalService()
    {
        $rpta = $this->service->getMiniPosts();
        $rpta2 = $this->service->getPrePosts();
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
        $rpta = $this->service->getMiniPosts();
        $rpta2 = $this->service->getPrePosts();
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
        $rpta = $this->service->getMiniPosts();
        $rpta2 = $this->service->getPrePosts();
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
        $json_countries = \DB::table('countries')->first()->json_countries;
        $countries  = json_decode($json_countries);
        $data = $request->session()->get('data');
        return view('auth.register', compact('data','countries'));
    }

    function socialiteStore(CmsRequest $request)
    {
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