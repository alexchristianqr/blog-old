<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Portfolio;
use Illuminate\Http\Request;

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
        $data = (new Portfolio())->all();
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

}
