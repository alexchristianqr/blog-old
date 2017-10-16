<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            case "GET":
                return [];
            case "PUT":
                //for Post Status
                if ($this->getPathInfo() == "/cms/post/change-state") {
                    return [
                        'status' => 'required'
                    ];
                    //for User
                }elseif($this->getPathInfo() == "/cms/update-user/" . $this->request->get('id_user')){
                    return [
                        'name' => 'required',
                        'email' => 'required',
                        'image' => 'sometimes',
                        'id_type_user' => 'required',
                        'status' => 'required',
                    ];
                    //for Post
                } else {
                    return [
                        "id_category" => 'required',
                        "image" => 'sometimes|image|mimes:jpeg,png,jpg|min:1|max:250',
                        "id_user" => 'required',
                        "id_tag" => 'sometimes',
                        "title" => 'required',
                        "subtitle" => 'required',
                        "slug" => 'required',
                        "description" => 'required',
                        "content" => 'required',
                        "status" => 'required',
                    ];
                }
            case "POST":
                //for Table
                if ($this->getPathInfo() == "/cms/store-table" || $this->getPathInfo() == "/cms/update-table/" . $this->request->get('id_table') . "/" . $this->request->get('id_field_table')) {
                    return [
                        'name' => 'required',
                    ];
                    //for User
                } elseif ($this->getPathInfo() == "/cms/store-user" ) {
                    return [
                        'name' => 'required',
                        'email' => 'required',
                        'image' => 'required',
                        'id_type_user' => 'required',
                        'password' => 'required',
                        'repassword' => 'required',
                        'status' => 'required',
                    ];
                    //for Post
                } else {
                    return [
                        "id_category" => 'required',
                        "image" => 'required|image|mimes:jpeg,png|min:1|max:250',
                        "id_user" => 'required',
                        "id_tag" => 'required',
                        "title" => 'required',
                        "description_title" => 'required',
                        "slug" => 'required',
                        "introduction" => 'required',
                        "content" => 'required',
                        "status" => 'required',
                    ];
                }
            default://DELETE
                return [];
        }
    }
}
