<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        ];
        if (Auth::user()->role_id == 1) {
            $rules["role_id"] = "required|exists:roles,id";
        }

        if ($this->method() == "PUT") {
            $rules["id"] = "required|integer|exists:users,id";
            $rules["email"] = "nullable|string|email|max:255|unique:users,email,{$this->id}";
            $rules["password"] = "nullable|string|min:6";
        }
        // dd($this->validationData());

        return $rules;
    }
}
