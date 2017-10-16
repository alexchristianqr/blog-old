<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 04/08/2017
 * Time: 12:10 PM
 */

namespace App\Http\Services;

use App\Contactme;
use App\Http\Controllers\Utility;
use App\Post;
use App\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PDOException;
use Exception;

class PostService
{

    use Utility;

    function getPost($id)
    {
        try {
            $data = (new Post())
                ->select(['post.*', 'users.name AS user_name', 'users.image AS user_image'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->where('post.status', 'A')
                ->where('post.id', $id)
                ->first();
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getPosts($request = null, $option = null)
    {
        try {
            $data = (new Post())
                ->select(['post.*',  'users.name AS user_name', 'users.image AS user_image'])
                ->distinct()
                ->join('users', 'users.id', '=', 'post.id_user');

            // Paginacion
            if ($option['flag']) {

                // Para Buscar
                if (isset($option['search'])) {
                    $search = $option["search"];
                    $data->where('post.status', '=', 'A')
                        ->where(function ($query) use ($search) {
                            $query->orWhere('post.title', 'like', '%' . $search . '%')->orWhere('post.subtitle', 'like', '%' . $search . '%')->orWhere('post.description', 'like', '%' . $search . '%')->orWhere('post.content', 'like', '%' . $search . '%');
                        });
                }

                // Existe Request
                if (isset($request) != null) {
                    if ($request->has('search')) $data = $data->where('post.title', 'like', '%' . $request->get('search') . '%');
                    if ($request->has('category')) $data = $data->where('post.id_category', $request->get('category'));
                    if ($request->has('status')) $data = $data->where('post.status', $request->get('status'));
                }

                // Filtros personalizados
                if (isset($option['status'])) {
                    $data = $data->where('post.status', '=', $option['status']);
                }

                // Tipo de Paginado
                if (isset($option['simplePaginate']) == true) {
                    $data = $data->orderBy('id', 'desc')->simplePaginate($option['page']);
                } else {
                    $data = $data->orderBy('id', 'desc')->paginate($option['page']);
                }

                // Obtener Data
            } else {
                $data = $data->orderBy('id', 'desc')->get();
            }

            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }

        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getSearchRepositories($text_search, $page = 6)
    {
        try {
            $data = (new Post())
//                ->select(['post.id', 'users.name AS user_name', 'users.image AS user_image', 'post.id_category', 'post.title', 'post.description_title', 'post.content', 'post.created_at', 'post.image', 'post.introduction'])
                ->select(['post.*', 'users.name AS user_name', 'users.image AS user_image'])
                ->join('users', 'users.id', '=', 'post.id_user')
                ->where('post.title', 'like', '%' . $text_search . '%')
                ->orWhere('post.subtitle', 'like', '%' . $text_search . '%')
                ->orWhere('post.description', 'like', '%' . $text_search . '%')
                ->orWhere('post.content', 'like', '%' . $text_search . '%')
                ->paginate($page);
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('excepcion');
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
                ->select(['mp.id_post', 'p.id_category', 'u.name AS user_name', 'u.image AS user_image', 'p.title', 'p.created_at', 'p.image'])
                ->join('post AS p', 'p.id', '=', 'mp.id_post')
                ->leftJoin('users AS u', 'u.id', '=', 'p.id_user')
                ->where('p.status', 'A')
                ->where('mp.status', 'A')
                ->orderBy('mp.order', 'desc')
                ->get();
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
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
                ->where('pr.status', 'A')
                ->orderBy('pr.order', 'desc')
                ->get();
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function sendMailSubscription($request)
    {
        try {
            if (isset($request->email)) {
                $data = (new Subscription())->where('email', $request->email)->whereIn('status', ['A', 'P'])->first();
                if ($data) {
                    if ($data->status == 'A') {
                        $mensaje = '<span>Hola <b>' . $request->email . '</b>,</span><br>
                                    <span>Usted ya forma parte de nuestros Usuarios Newsletter.</span>';
                        return response()->view('layouts.template.subscribed', compact('mensaje'));
                    } elseif ($data->status == 'P') {
                        $mensaje = '<span>Hola <b>' . $request->email . '</b>,</span><br>
                                    <span>Usted ya tiene un correo pendiente por confirmar con el sunto <b>AQUISPE.COM - NEWSLETTER</b>.</span>';
                        return response()->view('layouts.template.subscribed', compact('mensaje'));
                    }
                } else {
                    $request->merge(['remember_token' => Str::random(100)]);
                    Mail::send('layouts.template.email', ['remember_token' => $request->remember_token], function ($message) use ($request) {
                        $message->from('aquispe.developer@gmail.com', 'webmaster');
                        $message->to($request->email);
                        $message->subject('AQUISPE.COM - NEWSLETTER');
                    });
                    if (count(Mail::failures()) > 0) {
                        throw new Exception("excepcion");
                    } else {
                        $insert = (new Subscription())->insert(['email' => $request->email, 'remember_token' => $request->remember_token]);
                        if ($insert) {
                            return response()->view('layouts.template.subscription', ['email' => $request->email]);
                        } else {
                            return response()->view('errors.aviso');
                        }
                    }
                }
                return response()->view('errors.aviso');
            } else {
                return response()->view('errors.aviso');
            }
        } catch (PDOException $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        } catch (Exception $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        }
    }

    function confirmMailSubscription($remember_token)
    {
        try {
            $data = (new Subscription())->where('remember_token', $remember_token)->first();
            if ($data) {
                (new Subscription())->where('remember_token', $remember_token)->update(['status' => 'A']);
                $mensaje = '<span>Hola <b>' . $data->email . '</b></span><br><span>Usted ya forma parte de nuestros Usuarios Newsletter.</span>';
                return response()->view('layouts.template.subscribed', compact('mensaje'));
            } else {
                return response()->view('errors.aviso');
            }
        } catch (PDOException $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        } catch (Exception $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        }
    }

    function getCounts($request)
    {
        try {
            $data = (new Post())->select(['util', 'inutil'])->where('post.id', $request->id_post)->first();
            if ($data) {
                $this->fnSuccess($data);
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function updateCounts($request)
    {
        try {
            $data = (new Post())->select(['util', 'inutil'])->where('post.id', $request->id_post);
            switch ($request->tipo) {
                case "util":
                    $data = $data->update(['post.util' => $request->valor]);
                    break;
                default://inutil
                    $data = $data->update(['post.inutil' => $request->valor]);
                    break;
            }
            if ($data) {
                $this->fnSuccess($data);
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function sendMailContact($request)
    {
        try {
            $html = '
            <p>' . $request->name_lastname . '</p>
            <p>' . $request->email . '</p>
            <p>' . $request->commentary . '</p>';
            Mail::send('layouts.template.contactme', ['commentary' => $html], function ($message) {
                $message->from('aquispe.developer@gmail.com', 'webmaster');
                $message->to('aquispe.developer@gmail.com');
                $message->subject('AQUISPE.COM - MENSAJE USUARIO');
            });

            if (count(Mail::failures()) > 0) {
                throw new Exception("my exception");
            } else {
                $insert = (new Contactme())->fill($request->all())->save();
                if ($insert) {
                    return redirect()->back();
                } else {
                    return response()->view('errors.aviso');
                }
            }
        } catch (PDOException $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        } catch (Exception $e) {
            self::fnDoLog('E', $e);
            return response()->view('errors.aviso');
        }
    }

    function getNextAndPrevious($id, $id_category)
    {
        try {
            $previous = (new Post())
                ->select(['id', 'title', 'id_category'])
                ->where('status', 'A')
                ->where('id', '<', $id)
                ->where('id_category', $id_category)
                ->orderBy('id')->get()->max();
            $next = (new Post())->select(['id', 'title', 'id_category'])
                ->where('status', 'A')
                ->where('id', '>', $id)
                ->where('id_category', $id_category)
                ->orderBy('id')->first();
            $data = compact('previous', 'next');
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    //CMS POST

    function store($request)
    {
        try {
            $data = (new Post());
            $data->fill($request->all());
            $file_name = '';
            if ($request->hasFile('image')) {
                $ext = explode('.', $request->image->getClientOriginalName())[1];
                $file_name = strtolower($request->slug) . '.' . $ext;
                Image::make($request->image)->save(PATH_POSTS . '1000/' . $file_name);
                $data->image = $file_name;
            }
            if ($request->hasFile('image300')) {
                Image::make($request->image300)->save(PATH_POSTS . '300/' . $file_name);
            }
//            if ($request->hasFile('image')) {
//                Image::make($request->image51)->save(PATH_POSTS . '51/' . $file_name);
//            }

            if ($data->save()) {
                $this->fnSuccess($request, 'created successfully', 'very good');
            } else {
                throw new Exception('my exception');
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
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function update($id, $request)
    {
        try {
            $data = (new Post())->findOrFail($id);
            // Fusionar obligatoriamente
            $data->fill($request->all());
            // Validate File
            if ($request->hasFile('image')) {
                // Delete Current Image
                File::delete(PATH_POSTS . $data->image);
                // New Image Set
                $ext = explode('.', $request->image->getClientOriginalName())[1];
                $file_name = strtolower($request->slug) . '.' . $ext;
                Image::make($request->image)->save(PATH_POSTS . '1000/' . $file_name);
                $data->image = $file_name;
            }
            if ($request->hasFile('image300')) {
                File::delete(PATH_POSTS . '300/' . $data->image);
                // New Image Set
                $ext = explode('.', $request->image300->getClientOriginalName())[1];
                $file_name = strtolower($request->slug) . '.' . $ext;
                Image::make($request->image300)->save(PATH_POSTS . '300/' . $file_name);
                $data->image = $file_name;
            }

            if ($data->save()) {
                $this->fnSuccess($data, 'updated successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function changeState($request)
    {
        try {
            if (is_array($request['ids'])) {//for Ids is Array
                for ($i = 0; $i < count($request['ids']); $i++) {
                    $model = (new Post())->findOrFail($request['ids'][$i]);
                    $model->status = $request['status'];
                    if ($model->save()) {
                        $this->fnSuccess($request['ids'], 'updated successfully', 'very good');
                    } else {
                        throw new Exception('my exception');
                    }
                }
            } else {//for Id is String
                $model = (new Post())->findOrFail($request['ids']);
                $model->status = $request['status'];
                if ($model->save()) {
                    $this->fnSuccess($model, 'updated successfully', 'very good');
                } else {
                    throw new Exception('my exception');
                }
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        } catch (Exception $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

}