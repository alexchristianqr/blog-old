<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 26/09/2017
 * Time: 12:53 PM
 */

namespace App\Http\Services;


use App\Category;
use App\Http\Controllers\Utility;
use App\Http\Requests\CmsRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PDOException;
use Exception;

class cmsService
{
    use Utility;


    function storePortfolio($request = null, $option = null)
    {
        try {
            $file_name = '';
            $data = DB::table('portfolio');
            if ($request->hasFile('img')) {
                $ext = explode('.', $request->img->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '_', $request->title) . '.' . $ext;
                Image::make($request->img)->save(PATH_PORTFOLIOS . $file_name);
            }
            $request->request->add(['image' => $file_name]);
            $request->request->add(['updated_at' => FECHA_HORA]);
            $data = $data->insert($request->only(['title', 'width', 'status', 'image', 'updated_at']));
            if ($data) {
                $this->fnSuccess($data, 'created successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function editPortfolio($id)
    {
        try {
            $data = DB::table('portfolio')->where('id', $id)->first();
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

    function updatePortfolio($id, $request)
    {
        try {
            $data = DB::table('portfolio')->where('id', $id)->first();
            $updated = DB::table('portfolio')->where('id', $id);

            $request->request->add(['updated_at' => FECHA_HORA]);
            if ($request->hasFile('img')) {
                // Delete Current Image
                File::delete(PATH_PORTFOLIOS . $data->image);
                //new Set Image
                $ext = explode('.', $request->img->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '_', $request->title) . '.' . $ext;
                Image::make($request->img)->save(PATH_PORTFOLIOS . $file_name);
                $request->request->add(['image' => $file_name]);
                $updated = $updated->update($request->only(['title', 'width', 'image', 'status', 'updated_at']));
            } else {
                $updated = $updated->update($request->only(['title', 'width', 'status', 'updated_at']));
            }

            if ($updated) {
                $this->fnSuccess($data, 'updated successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getPortfolios($request = null, $option = null)
    {
        try {
            $data = DB::table('portfolio');
            if ($request->has('status')) $data = $data->where('status', $request->status);
            if (isset($option['forPaginate']) == true) {
                $data = $data->paginate($option['limit']);
            } else {
                $data = $data->get();
            }
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function getTables($request, $option = null)
    {
        try {
            $data = DB::table($request->table);
            if ($request->has('status')) $data = $data->where('status', $request->status);
            if (isset($option['forPaginate']) == true) {
                $data = $data->paginate($option['limit']);
            } else {
                $data = $data->get();
            }
            if ($data) {
                $this->fnSuccess($data);
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function storeTable($request)
    {
        try {
            $request['updated_at'] = FECHA_HORA;
            $data = DB::table($request->table)->insert($request->only(['name', 'alias', 'updated_at']));
            if ($data) {
                $this->fnSuccess($data, 'created successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function updateTable($table, $id, $request)
    {
        try {
            $request['updated_at'] = FECHA_HORA;
            $data = DB::table($table)->where('id', $id)->update($request->only(['name', 'alias', 'status', 'updated_at']));
            if ($data) {
                $this->fnSuccess($data, 'updated successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function editTable($table, $id)
    {
        try {
            $data = DB::table($table)->where('id', $id)->first();
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

    function getUsers($request = null, $option = null)
    {
        try {
            $data = (new User())
                ->select(['users.*', 'tu.name AS name_type_user'])
                ->join('type_user AS tu', 'tu.id', '=', 'users.id_type_user');

            if (!is_null($request)) {
                if ($request->has('status')) $data = $data->where('users.status', $request->status);
            }

            if (isset($option['forPaginate']) == true) {
                $data = $data->paginate($option['limit']);
            } elseif (isset($option['auth']) == true) {
                $data = $data->where('users.id', $option['authid'])->first();
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

    function storeUser($request)
    {
        try {
            $data = (new User());
            $data->fill($request->all());
            $data->password = bcrypt($request->password);
            $data->unpassword = $request->password;
            if ($request->hasFile('image')) {
                $ext = explode('.', $request->image->getClientOriginalName())[1];
                $file_name = str_replace(' ', '_', $request->name) . '.' . $ext;
                Image::make($request->image)->save(PATH_USERS . FECHA_DETALLE . $file_name);
                $data->image = $file_name;
            }
            if ($data->save()) {
                $this->fnSuccess($data, 'created successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

    function editUser($id)
    {
        try {
            $data = (new User())->findOrFail($id);
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

    function updateUser($id, $request)
    {
        try {
            $data = (new User())->findOrFail($id);
            // Fusionar obligatoriamente
            $data->fill($request->all());
            // Validate File
            if ($request->hasFile('image')) {
                // Delete Current Image
                File::delete(PATH_USERS . $data->image);
                // New Image Set
                $ext = explode('.', $request->image->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '-', $request->name) . '.' . $ext;
                Image::make($request->image)->save(PATH_USERS . $file_name);
                $data->image = $file_name;
            }
            if ($data->save()) {
                $this->fnSuccess($data, 'updated successfully', 'very good');
            } else {
                throw new Exception('my exception');
            }
        } catch (PDOException $e) {
            $this->fnException($e);
        }
        return $this->rpta;
    }

}