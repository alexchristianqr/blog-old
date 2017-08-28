<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Utility;

    public function __construct()
    {
        $this->middleware('guest');
    }

    function personalService()
    {
        $Post = new PostService();
        $rpta = $Post->getMiniPosts();
        $rpta2 = $Post->getPrePosts();
        if ($rpta['load'] && $rpta2['load']) {
            $data_mini_posts = $rpta['data'];
            $data_pre_posts = $rpta2['data'];
            return view('servicio', compact('data_mini_posts', 'data_pre_posts'));
        } else {
            return redirect()->route('aviso');
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
            return view('perfil', compact('data_mini_posts', 'data_pre_posts'));
        } else {
            return redirect()->route('aviso');
        }
    }

}
