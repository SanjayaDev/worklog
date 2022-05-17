<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
            "is_super_admin" => "nullable|boolean"
        ];

        if ($this->method() == "PUT") {
            $rules["id"] = "required|integer|exists:users,id";
            $rules["email"] = "required|string|email|max:255|unique:users,email,{$this->id}";
            $rules["password"] = "nullable|string|min:6";
        }

        return $rules;
    }
}
