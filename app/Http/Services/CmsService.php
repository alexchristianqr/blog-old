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
            if ($request->hasFile('image_portfolio')) {
                $ext = explode('.', $request->image_portfolio->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '_', $request->title) . '.' . $ext;
                Image::make($request->image_portfolio)->save(PATH_PORTFOLIOS . $file_name);
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
            if ($request->hasFile('image_portfolio')) {
                // Delete Current Image
                File::delete(PATH_PORTFOLIOS . $data->image);
                //new Set Image
                $ext = explode('.', $request->image_portfolio->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '_', $request->title) . '.' . $ext;
                Image::make($request->image_portfolio)->save(PATH_PORTFOLIOS . $file_name);
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
            $request->request->add(['updated_at' => FECHA_HORA]);
            if ($request->table == 'type_user') {
                $roles = array_merge(isset($request->role_post) ? $request->role_post : [], isset($request->role_user) ? $request->role_user : [], isset($request->role_portfolio) ? $request->role_portfolio : [], isset($request->role_tables) ? $request->role_tables : []);
                $json = json_encode($roles);
                $request->request->add(['roles' => $json]);
                $data = DB::table($request->table)->insert($request->only(['name', 'alias', 'roles', 'updated_at']));
            } else {
                $data = DB::table($request->table)->insert($request->only(['name', 'alias', 'updated_at']));
            }
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

    function updateTable($table, $id, $request)
    {
        try {
            $request->request->add(['updated_at' => FECHA_HORA]);
            if ($table == 'type_user') {
                $roles = array_merge(isset($request->role_post) ? $request->role_post : [], isset($request->role_user) ? $request->role_user : [], isset($request->role_portfolio) ? $request->role_portfolio : [], isset($request->role_tables) ? $request->role_tables : []);
                $json = json_encode($roles);
                $request->request->add(['roles' => $json]);
                $data = DB::table($table)->where('id', $id)->update($request->only(['name', 'alias', 'roles', 'status', 'updated_at']));
            } else {
                $data = DB::table($table)->where('id', $id)->update($request->only(['name', 'alias', 'status', 'updated_at']));
            }
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

    function getUsers($request = null, $option = null)
    {
        try {
            $data = (new User())
                ->select(['users.*', 'type_user.name AS type_user_name'])
                ->join('type_user', 'type_user.id', '=', 'users.id_type_user');

            if (!empty($request)) {
                if ($request->has('status'))
                    $data = $data->where('users.status', $request->status);

                if ($request->has('field_search') && $request->has('search'))
                    $data = $data->where('users.' . strtolower($request->field_search), 'like', '%' . $request->search . '%');
            }

            if (isset($option['auth']) == true)
                $data = $data->where('users.id', $option['id_auth'])->first();

            if (isset($option['forPaginate']) == true)
                $data = $data->paginate($option['limit']);

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

            // Fusion
            $data->fill($request->all());

            // Encriptar Password
            $data->password = bcrypt($request->password);
            $data->unpassword = $request->password;

            // Existe Archivo Imagen
            if ($request->hasFile('image_user')) {
                $ext = explode('.', $request->image_user->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '_', $request->name) . '.' . $ext;
                Image::make($request->image_user)->save(PATH_USERS . $file_name);
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

            // Temporal Password Vigente
            $temp = $data->unpassword;

            // Existe Archivo Imagen
            if ($request->hasFile('image_user')) {
                // Delete Current Image
                File::delete(PATH_USERS . $data->image);
                // New Image Set
                $ext = explode('.', $request->image_user->getClientOriginalName())[1];
                $file_name = FECHA_DETALLE . '_' . str_replace(' ', '-', $request->name) . '.' . $ext;
                Image::make($request->image_user)->save(PATH_USERS . $file_name);
                $request->request->add(['image' => $file_name]);
            }

            // Fusion
            $data->fill($request->all());

            // Validar Set Password
            if (!empty($request->password) && !empty($request->confirm_password)) {
                $data->password = bcrypt($request->password);
                $data->unpassword = $request->password;
            } else {
                $data->password = bcrypt($temp);
                $data->unpassword = $temp;
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