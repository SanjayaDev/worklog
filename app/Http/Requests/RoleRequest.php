<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "role_name" => "required|unique:roles,role_name",
            "role_description" => "nullable|string"
        ];

        if ($this->method() == "PUT") {
            $rules["role_name"] = "required|unique:roles,role_name," . $this->route("role");
        }

        return $rules;
    }
}
