<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 04/08/2017
 * Time: 12:11 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\CmsRequest;
use App\Http\Services\cmsService;
use App\Http\Services\PostService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{

    protected $cms;

    public function __construct(PostService $postService, CmsService $cmsService)
    {
        $this->middleware(['isActive', 'auth'])->except('logout');
        $this->service = $postService;
        $this->cms = $cmsService;

    }

    function cmsHome()
    {
        return view('cms.home');
    }

    //CMS POST

    function cmsPosts(CmsRequest $request)
    {
        //for Index
        $rpta = $this->service->getPosts(true, $request, 8);
        if ($rpta['load']) {
            $data = $rpta['data'];
            $categories = $this->getTable('category', ['state', 'A']);
            $states = $this->getTable('states');
            return view('cms.posts', compact('data', 'categories', 'states'));
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsPost()
    {
        //for Show
        $categories = $this->getTable('category', ['state', 'A']);
        $tags = $this->getTable('tag', ['state', 'A']);
        $team = $this->cms->getUsers(null, ['auth' => true, 'authid' => auth()->user()->getAuthIdentifier()])['data'];
        return view('cms.post', compact('categories', 'team', 'tags'));
    }

    function cmsStorePost(CmsRequest $request)
    {
        //for Store
        $rpta = $this->service->store($request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/posts?state=A');
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsEditPost($id)
    {
        //for Edit
        $rpta = $this->service->edit($id);
        if ($rpta['load']) {
            $data = $rpta['data'];
            $categories = $this->getTable('category', ['state', 'A']);
            $tags = $this->getTable('tag', ['state', 'A']);
            $team = $this->cms->getUsers(null, ['auth' => true, 'authid' => auth()->user()->getAuthIdentifier()])['data'];
            $array_tags = json_decode($data->id_tag);
            foreach ($tags as $key => $item) {
                if (empty($array_tags[$key]->id))
                    array_push($array_tags, (object)['id' => $item->id, 'value' => false]);
            }
            $data->id_tag = json_encode($array_tags);
            return view('cms.post', compact('data', 'categories', 'team', 'tags'));
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsUpdatePost($id, CmsRequest $request)
    {
        //for Update
        $rpta = $this->service->update($id, $request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/posts?state=A');
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsChangeStatePost(CmsRequest $request)
    {
        //by restfull
        $rpta = $this->service->changeState($request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return response($rpta);
        } else {
            return response($rpta);
        }
    }

    //CMS TABLE

    function cmsTables(CmsRequest $request)
    {
        $tables = $this->getTable('tables', ['state', 'A']);
        $states = $this->getTable('states');
        if ($request->has('table')) {
            $rpta = $this->cms->getTables($request, ['forPaginate' => true, 'limit' => 10]);
            if ($rpta['load']) {
                $data = $rpta['data'];
                return view('cms.tables', compact('data', 'tables', 'states'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        }
        return view('cms.tables', compact('tables', 'states'));
    }

    function cmsStoreTable(CmsRequest $request)
    {
        //for Store Table
        $rpta = $this->cms->storeTable($request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/tables?table=' . $request->table);
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsEditTable($table, $id)
    {
        //for Edit Table
        $rpta = $this->cms->editTable($table, $id);
        if ($rpta['load']) {
            $data = $rpta['data'];
            return response()->json(compact('data'));
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsUpdateTable($table, $id, CmsRequest $request)
    {
        //for Update Table
        $rpta = $this->cms->updateTable($table, $id, $request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/tables?table=' . $table);
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    //CMS USER

    function cmsUsers(CmsRequest $request)
    {
        $rpta = $this->cms->getUsers($request, ['forPaginate' => true, 'limit' => 6]);
        if ($rpta['load']) {
            $data = $rpta['data'];
            $type_users = $this->getTable('type_user');
            $states = $this->getTable('states');
            return view('cms.users', compact('data', 'type_users', 'states'));
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsUser()
    {
        $type_users = $this->getTable('type_user');
        $states = $this->getTable('states');
        return view('cms.user', compact('type_users', 'states'));
    }

    function cmsStoreUser(CmsRequest $request)
    {
        //for Store User
        if ($request->password === $request->repassword) {
            $rpta = $this->cms->storeUser($request);
        } else {
            return redirect()->back()->withInput()->withErrors('Las contraseñas ingresadas son incorrectas.');
        }
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/users');
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsEditUser($id)
    {
        //for Edit User
        $rpta = $this->cms->editUser($id);
        if ($rpta['load']) {
            $data = $rpta['data'];
            $type_users = $this->getTable('type_user');
//            return response()->json(compact('data'));
            return view('cms.user', compact('data', 'type_users'));
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsUpdateUser($id, CmsRequest $request)
    {
        //for Update User
        $rpta = $this->cms->updateUser($id, $request);
        $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
        if ($rpta['load']) {
            return redirect()->to('cms/users');
        } else {
            return redirect()->back()->withInput()->withErrors($rpta['message']);
        }
    }

    function cmsPreview($id)
    {
        $rpta = $this->service->getPost($id);
        if ($rpta['load']) {
            $data = $rpta['data'];
            return view('cms.preview', compact('data'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    //CMS FILES BROWSER

    function corsHeaders()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        } else {
            header("Access-Control-Allow-Origin: *");
        }

        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Origin,X-Requested-With,Content-Type,Accept');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            }

            exit(0);
        }

    }

    function cmsBrowserFiles()
    {
        $this->corsHeaders();
//        $data = array("success"=>true,"time"=>"2017-09-28 22:03:01","data"=>["code"=>200,"sources"=>["default"=>["baseurl"=>"https://xdsoft.net/jodit/files/","folders"=>[".","ceicom","test"],"path"=>""]]]);
        $data = array("success" => true, "time" => "2017-09-28 22:03:01", "data" => ["code" => 200, "sources" => ["default" => ["baseurl" => "file:///D:/pictures/apache_x300.png", "folders" => [
            ['file' => 'apache_x300.png', 'changed' => '09/28/2017 10:00 PM', 'size' => '62.06kB', 'thumb' => '_thumbs/apache_x300.png'],
            ['file' => 'apache_x300.png', 'changed' => '09/28/2017 10:00 PM', 'size' => '62.06kB', 'thumb' => '_thumbs/apache_x300.png'],
            ['file' => 'apache_x300.png', 'changed' => '09/28/2017 10:00 PM', 'size' => '62.06kB', 'thumb' => '_thumbs/apache_x300.png'],
            ['file' => 'apache_x300.png', 'changed' => '09/28/2017 10:00 PM', 'size' => '62.06kB', 'thumb' => '_thumbs/apache_x300.png'],
        ], "path" => ""]]]);
        return response()->json($data);
    }

}