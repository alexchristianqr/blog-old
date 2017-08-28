<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 04/08/2017
 * Time: 12:10 PM
 */

namespace App\Http\Services;


use App\Http\Controllers\Utility;
use App\Post;
use Illuminate\Support\Facades\DB;
use PDOException;
use Exception;

class PostService
{
    use Utility;

    function store($request)
    {
        try {
            $data=(new Post())->fillable($request->all());
            $data->save();
            $this->fnSuccess();
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function show($id)
    {
        try {
            $data = (new Post())
                ->select(['post.id', 'users.user_name', 'post.title', 'post.content_title', 'post.body', 'post.created_at'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->where('post.id', $id)
                ->first();

            $this->fnSuccess($data);

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getPost($id)
    {
        try {
            $data = (new Post())
                ->select(['post.id', 'users.name AS user_name', 'users.image AS user_image', 'post.title', 'post.content_title', 'post.body', 'post.created_at', 'post.images', 'post.description'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->where('post.state', 'A')
                ->where('post.id', $id)
                ->first();

            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('error');
            }

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getPosts()
    {
        try {
            $data = (new Post())
                ->select(['post.id', 'users.name AS user_name', 'users.image AS user_image', 'post.title', 'post.content_title', 'post.body', 'post.created_at', 'post.images', 'post.description', 'post.id_tipo_post'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->where('post.state', 'A')
                ->paginate(2);
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('error');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getMiniPosts()
    {
        try {
            $data = DB::table('mini_post AS mp')
                ->select(['p.id AS id_post', 'u.name AS user_name', 'u.image AS user_image', 'p.title', 'p.created_at', 'p.images'])
                ->join('post AS p', 'p.id', '=', 'mp.id_post')
                ->leftJoin('users AS u', 'u.id', '=', 'p.id_user')
                ->where('p.state', 'A')
                ->where('mp.state', 'A')
                ->orderBy('mp.order', 'desc')
                ->get();

            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('exception');
            }

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getPrePosts()
    {
        try {
            $data = DB::table('pre_post AS pr')
                ->select(['pr.id', 'u.name AS user_name', 'u.image AS user_image', 'pr.title', 'pr.date_publication', 'pr.image'])
                ->join('users AS u', 'u.id', '=', 'pr.id_user')
                ->where('pr.state', 'A')
                ->orderBy('pr.order', 'desc')
                ->get();

            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('error');
            }

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function edit($id)
    {
        try {
            $data = (new Post())->findOrFail($id);

            $this->fnSuccess($data);

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta['data'];
    }

    function update($id, $request)
    {
        try {
            $model = (new Post())->findOrFail($id);
            $model->fill($request->all());
            $model->save();

            $this->fnSuccess($model);

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function changeState($id, $request)
    {
        try {
            $model = (new Post())->findOrFail($id);
            $model->state = $request->state;
            $model->save();

            $this->fnSuccess($model);

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getGroups($tipo_post)
    {
        try {
            $data = (new Post())
                ->select(['post.id', 'users.name AS user_name', 'users.image AS user_image', 'post.title', 'post.content_title', 'post.body', 'post.created_at', 'post.images', 'post.description', 'post.id_tipo_post'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->join('tipo_post', 'tipo_post.id', '=', 'post.id_tipo_post')
                ->where('tipo_post.state', 'A')
                ->where('post.state', 'A')
                ->where('post.id_tipo_post', $tipo_post)
                ->get();
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('error');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

}