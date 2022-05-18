<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_super_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "project_name" => "required|string|max:255",
            "project_description" => "nullable|string",
            "user_id.*" => "required|exists:users,id",
        ];

        if ($this->method() == "PUT") {
            $rules["id"] = "required|exists:projects,id";
        }

        return $rules;
    }
}
