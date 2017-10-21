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
        //for List
        if (isset(session('session_roles')->role_post_list)) {
            $rpta = $this->service->getPosts($request, ['flag' => true, 'page' => 5, 'id_user' => auth()->user()->id]);
            if ($rpta['load']) {
                $data = $rpta['data'];
                $categories = $this->getTable('category', ['status', 'A']);
                $states = $this->getTable('levels');
                return view('cms.posts', compact('data', 'categories', 'states'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsPost()
    {
        //for Show
        if (isset(session('session_roles')->role_post_create) || isset(session('session_roles')->role_post_update)) {
            $categories = $this->getTable('category', ['status', 'A']);
            $tags = $this->getTable('tag', ['status', 'A']);
            $team = $this->cms->getUsers(null, ['auth' => true, 'authid' => auth()->user()->getAuthIdentifier()])['data'];
            return view('cms.post', compact('categories', 'team', 'tags'));
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsStorePost(CmsRequest $request)
    {
        //for Store
        if (isset(session('session_roles')->role_post_create)) {
            $rpta = $this->service->store($request);
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/posts?status=A');
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsEditPost($id)
    {
        //for Edit
        if (isset(session('session_roles')->role_post_edit)) {
            $rpta = $this->service->edit($id);
            if ($rpta['load']) {
                $data = $rpta['data'];
                $categories = $this->getTable('category', ['status', 'A']);
                $tags = $this->getTable('tag', ['status', 'A']);
                $team = $this->cms->getUsers(null, ['auth' => true, 'authid' => auth()->user()->getAuthIdentifier()])['data'];
                $array_tags = json_decode($data->id_tag);
                foreach ($tags as $key => $item) {
                    if (empty($array_tags[$key]->id)) array_push($array_tags, (object)['id' => $item->id, 'value' => false]);
                }
                $data->id_tag = json_encode($array_tags);
                return view('cms.post', compact('data', 'categories', 'team', 'tags'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsUpdatePost($id, CmsRequest $request)
    {
        //for Update
        if (isset(session('session_roles')->role_post_update)) {
            $rpta = $this->service->update($id, $request);
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/posts?status=A');
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
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
        //for List
        if (isset(session('session_roles')->role_tables_list)) {
            $tables = $this->getTable('tables', ['status', 'A']);
            $states = $this->getTable('levels');
            $roles = $this->getTable('roles');
            if ($request->has('table')) {
                $rpta = $this->cms->getTables($request, ['forPaginate' => true, 'limit' => 10]);
                if ($rpta['load']) {
                    $data = $rpta['data'];
                    return view('cms.tables', compact('data', 'tables', 'states', 'roles'));
                } else {
                    return redirect()->back()->withInput()->withErrors($rpta['message']);
                }
            }
            return view('cms.tables', compact('tables', 'states', 'roles'));
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsStoreTable(CmsRequest $request)
    {
        //for Store
        if (isset(session('session_roles')->role_tables_create)) {
            $rpta = $this->cms->storeTable($request);
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/tables?table=' . $request->table);
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsEditTable($table, $id, CmsRequest $request)
    {
        //for Edit
        if (isset(session('session_roles')->role_tables_edit)) {
            $rpta = $this->cms->editTable($table, $id);
            if ($rpta['load']) {
                $data = $rpta['data'];
                if ($request->ajax()) {
                    return response()->json(compact('data'));
                } else {
                    return redirect()->to('cms/tables?table=' . $table)->with(compact('data'));
                }
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsUpdateTable($table, $id, CmsRequest $request)
    {
        //for Update
        if (isset(session('session_roles')->role_tables_update)) {
            $rpta = $this->cms->updateTable($table, $id, $request);
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/tables?table=' . $table);
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    //CMS USER

    function cmsUsers(CmsRequest $request)
    {
        //for List
        if (isset(session('session_roles')->role_user_list)) {
            $rpta = $this->cms->getUsers($request, ['forPaginate' => true, 'limit' => 6]);
            if ($rpta['load']) {
                $data = $rpta['data'];
                $type_users = $this->getTable('type_user');
                $states = $this->getTable('levels');
                return view('cms.users', compact('data', 'type_users', 'states'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsUser()
    {
        if (isset(session('session_roles')->role_user_create) || isset(session('session_roles')->role_user_update)) {
            $type_users = $this->getTable('type_user');
            $states = $this->getTable('levels');
            return view('cms.user', compact('type_users', 'states'));
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsStoreUser(CmsRequest $request)
    {
        //for Store
        if (isset(session('session_roles')->role_user_create)) {
            if ($request->password === $request->confirm_password) {
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
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsEditUser($id)
    {
        //for Edit
        if (isset(session('session_roles')->role_user_edit)) {
            $rpta = $this->cms->editUser($id);
            if ($rpta['load']) {
                $data = $rpta['data'];
                $type_users = $this->getTable('type_user');
                return view('cms.user', compact('data', 'type_users'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsUpdateUser($id, CmsRequest $request)
    {
        //for Update
        if (isset(session('session_roles')->role_user_update)) {
            if (is_null($request->password) && is_null($request->confirm_password)) {
                $rpta = $this->cms->updateUser($id, $request);
            } else {
                if ($request->password === $request->confirm_password) {
                    $rpta = $this->cms->updateUser($id, $request);
                } else {
                    return redirect()->back()->withInput()->withErrors('Las contraseñas ingresadas son incorrectas.');
                }
            }
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/users');
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
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

    //CMS PORTFOLIO

    function cmsPortfolios(CmsRequest $request)
    {
        //for List
        if (isset(session('session_roles')->role_portfolio_list)) {
            $request->request->add(['status' => 'A']);
            $rpta = $this->cms->getPortfolios($request, ['forPaginate' => true, 'limit' => 6]);
            if ($rpta['load']) {
                $data = $rpta['data'];
                $states = $this->getTable('levels');
                return view('cms.portfolios', compact('data', 'states'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsPortfolio()
    {
        if (isset(session('session_roles')->role_portfolio_create) || isset(session('session_roles')->role_portfolio_update)) {
            return view('cms.portfolio');
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsStorePortfolio(CmsRequest $request)
    {
        //for Store
        if (isset(session('session_roles')->role_portfolio_create)) {
            $rpta = $this->cms->storePortfolio($request);
            if ($rpta['load']) {
                $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
                return redirect()->to('cms/portfolios?status=A');
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsEditPortfolio($id)
    {
        //for Edit
        if (isset(session('session_roles')->role_portfolio_edit)) {
            $rpta = $this->cms->editPortfolio($id);
            if ($rpta['load']) {
                $data = $rpta['data'];
                return view('cms.portfolio', compact('data'));
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

    function cmsUpdatePortfolio($id, CmsRequest $request)
    {
        //for Update
        if (isset(session('session_roles')->role_portfolio_update)) {
            $rpta = $this->cms->updatePortfolio($id, $request);
            $this->fnFlashMessage($rpta['title'], $rpta['message'], $rpta['level']);
            if ($rpta['load']) {
                return redirect()->to('cms/portfolios?status=A');
            } else {
                return redirect()->back()->withInput()->withErrors($rpta['message']);
            }
        } else {
            return abort(401, "User Unauthorized");
        }
    }

}