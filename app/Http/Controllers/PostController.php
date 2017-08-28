<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 04/08/2017
 * Time: 12:11 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use Jenssegers\Date\Date;

/**
 * @property PostRequest request
 * @property bool ajax
 * @property PostService service
 */
class PostController
{

    use Utility;

    public function __construct(PostRequest $postRequest, PostService $postService)
    {
        $this->request = $postRequest;
        $this->ajax = $this->request->ajax();
        $this->service = $postService;
    }

    function store()
    {
        $rpta = $this->service->store($this->request);
        if ($rpta['load']) {
            if ($this->ajax) {
                return $rpta;//data json
            } else {
                return $rpta['data'];//data laravel
            }
        } else {
            if ($this->ajax) {
                return $rpta;//data json
            } else {
                return $rpta['data'];//data laravel
            }
        }
    }

    function show($id, $tipo_post)
    {
        $rpta = $this->service->getPost($id);
        $rpta2 = $this->service->getMiniPosts();
        $rpta3 = $this->service->getPrePosts();
        $rpta4 = $this->service->getGroups($tipo_post);
        if ($rpta['load'] && $rpta2['load'] && $rpta3['load'] && $rpta4['load']) {
            $data = $rpta['data'];
            $data_mini_posts = $rpta2['data'];
            $data_pre_posts = $rpta3['data'];
            $data_groups = $rpta4['data'];
            return view('post', compact('data', 'data_mini_posts', 'data_pre_posts','data_groups'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function edit($id)
    {
        $data = $this->service->edit($id);
        return view('edit', compact('data'));
    }

    function update($id)
    {
        $rpta = $this->service->update($id, $this->request);
        if ($rpta['load']) {
            if ($this->ajax) {
                return response()->json($rpta, 200);//data json
            } else {
                $this->fnFlashMessage();
                return redirect()->back(200);//data laravel
            }
        } else {
            if ($this->ajax) {
                return response()->json($rpta, 412);//data json
            } else {
                $this->fnFlashMessage($rpta['']);
                return redirect()->back();//data laravel
            }
        }
    }

    function index()
    {
        $rpta = $this->service->getPosts();
        $rpta2 = $this->service->getMiniPosts();
        $rpta3 = $this->service->getPrePosts();
        if ($rpta['load'] && $rpta2['load'] && $rpta3['load']) {
            if ($this->ajax) {
                return response()->json(compact('data', 'data_pre_posts', 'data_mini_posts'), 200);
            } else {
                $data = $rpta['data'];
                $data_mini_posts = $rpta2['data'];
                $data_pre_posts = $rpta3['data'];
                return view('posts', compact('data', 'data_mini_posts', 'data_pre_posts'));
            }
        } else {
            return response()->view('errors.aviso');
        }
    }

    /**
     * Vistas Administrador
     **/

    function indexAdmin()
    {
        $rpta = $this->service->getPosts();
        if ($rpta['load']) {
            $data = $rpta['data'];
            return view('admin.post.index', compact('data'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function editAdmin()
    {
        $rpta = $this->service->getPosts();
        if ($rpta['load']) {
            $data = $rpta['data'];
            return view('admin.post.edit', compact('data'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function sendEmailSuscription()
    {
        $email = $this->request['email_suscription'];
         $this->fnFlashMessage('Mensaje','tu email '.$email.' ah sido suscrito correctamente.','success');
         return response()->view('suscription');
    }

}