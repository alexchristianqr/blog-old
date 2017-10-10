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
use App\Post;
use function foo\func;

class PostController extends Controller
{

    public function __construct(PostService $postService)
    {
        $this->middleware('web')->except('logout');
        $this->service = $postService;
    }

    function show($id, $id_category, PostRequest $request)
    {
        $rpta = $this->service->getPost($id);
        $rpta2 = $this->service->getMiniPosts();
        $rpta3 = $this->service->getPrePosts();
        $rpta4 = $this->service->getGroups($id_category, $request);
        $data_prev_next = $this->service->getNextAndPrevious($id, $id_category);
        if ($rpta['load'] && $rpta2['load'] && $rpta3['load'] && $rpta4['load'] && $data_prev_next['load']) {
            $data = $rpta['data'];
            $data_mini_posts = $rpta2['data'];
            $data_pre_posts = $rpta3['data'];
            $data_groups = $rpta4['data'];
            $next = $data_prev_next['data']['next'];
            $previous = $data_prev_next['data']['previous'];

            if (!empty($data->id_tag)) {
                $array_tags = json_decode($data->id_tag);
                $tags = [];
                foreach ($array_tags as $item) {
                    if ($item->value == true)
                        array_push($tags, \DB::table('tag')->select()->where('id', $item->id)->first());
                }
            }
            if ($request->ajax()) {
                return response()->json(compact('data_groups'));
            } else {
                return view('post', compact('data', 'data_mini_posts', 'data_pre_posts', 'previous', 'next', 'tags'));
            }
        } else {
            return response()->view('errors.aviso');
        }
    }

    function index(PostRequest $request)
    {
        $request['state'] = 'A';
        $rpta = $this->service->getPosts(true, $request, ['simplePaginate' => true, 'forFilters' => true]);
        $rpta2 = $this->service->getMiniPosts();
        $rpta3 = $this->service->getPrePosts();
        if ($rpta['load'] && $rpta2['load'] && $rpta3['load']) {
            $data = $rpta['data'];
            $data_mini_posts = $rpta2['data'];
            $data_pre_posts = $rpta3['data'];
            return view('posts', compact('data', 'data_mini_posts', 'data_pre_posts'));
        } else {
            return response()->view('errors.aviso');
        }
    }

    function searchRepositories(PostRequest $request)
    {
        $text_search = trim($request["query"]);
        if (isset($request["query"]) && strlen($request["query"]) >= 3) {
            $rpta = $this->service->getPosts(true, null, ["forSearch" => true, "search" => $text_search], 6);
            $data = $rpta["data"];
        } else {
            $data = [];
        }
        return view('search', compact('data', 'text_search'));
    }

    function sendMailSubscription(PostRequest $request)
    {
        return $this->service->sendMailSubscription($request);
    }

    function confirmMailSubscription($remember_token)
    {
        return $this->service->confirmMailSubscription($remember_token);
    }

    function getCounts(PostRequest $request)
    {
        //by Restfull
        $rpta = $this->service->getCounts($request);
        if ($rpta['load']) {
            return response()->json($rpta, 200);
        } else {
            return response()->json($rpta, 412);
        }
    }

    function updateCounts(PostRequest $request)
    {
        //by Restfull
        $rpta = $this->service->updateCounts($request);
        if ($rpta['load']) {
            return response()->json(true, 200);
        } else {
            return response()->json(false, 412);
        }
    }

    function sendMailContact(PostRequest $request)
    {
        return $this->service->sendMailContact($request);
    }

}