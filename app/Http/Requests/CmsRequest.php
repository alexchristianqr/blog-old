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
            case "DELETE":
                return [];
            case "PUT":
                //for Status
                if ($this->getPathInfo() == "/cms/post/change-state")
                    return [
                        'status' => 'required'
                    ];
                //for User
                if ($this->getPathInfo() == "/cms/update-user/" . $this->request->get('id_user'))
                    return [
                        'name' => 'required',
                        'email' => 'required',
                        'image_user' => 'sometimes|image|mimes:jpeg,jpg,png|min:1|max:250',
                        'id_type_user' => 'required',
                        'password' => 'sometimes',
                        'confirm_password' => 'sometimes',
                        'status' => 'required',
                    ];
                //for Portfolio
                if ($this->getPathInfo() == "/cms/update-portfolio/" . $this->request->get('id'))
                    return [
                        'title' => 'required',
                        'width' => 'required',
                        'image_portfolio' => 'sometimes',
                        'status' => 'required',
                    ];
                //for Post
                else {
                    return [
                        "id_category" => 'required',
                        "image" => 'sometimes|image|mimes:jpeg,jpg|min:1|max:250',
                        "image300" => 'sometimes|image|mimes:jpeg,jpg|min:1|max:250',
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
                //for Socialite
                if($this->getPathInfo() == "/socialite/store" )
                    return [
                        'name' => 'required',
                        'email' => 'required|email',
                        'image_user' => 'sometimes|image|mimes:jpeg,jpg,png|min:1|max:250',
                        'password' => 'required',
                        'confirm_password' => 'required',
                        'country' => 'required',
                        'id_sector' => 'required',
                    ];
                //for Table
                if ($this->getPathInfo() == "/cms/store-table" || $this->getPathInfo() == "/cms/update-table/" . $this->request->get('id_table') . "/" . $this->request->get('id_field_table'))
                    return [
                        'name' => 'required',
                    ];
                //for User
                if ($this->getPathInfo() == "/cms/store-user")
                    return [
                        'name' => 'required',
                        'email' => 'required',
                        'image_user' => 'required|image|mimes:jpeg,jpg,png|min:1|max:250',
                        'id_type_user' => 'required',
                        'password' => 'required',
                        'confirm_password' => 'required',
                        'status' => 'required',
                    ];
                //for Portfolio
                if ($this->getPathInfo() == "/cms/store-portfolio")
                    return [
                        'title' => 'required',
                        'width' => 'required',
                        'image_portfolio' => 'required',
                        "status" => 'required',
                    ];
                //for Post
                else {
                    return [
                        "id_category" => 'required',
                        "image" => 'required|image|mimes:jpeg,jpg|min:1|max:250',
                        "image300" => 'required|image|mimes:jpeg,jpg|min:1|max:250',
                        "id_user" => 'required',
                        "id_tag" => 'required',
                        "title" => 'required',
                        "subtitle" => 'required',
                        "slug" => 'required',
                        "description" => 'required',
                        "content" => 'required',
                        "status" => 'required',
                    ];
                }
            //GET
            default:
                return [];
        }
    }
}
