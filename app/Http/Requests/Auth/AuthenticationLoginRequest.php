<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->is("api/login")) {
            return $this->loginRequest;
        };

        if ($this->is("api/register")) {
            return $this->registerRequest;
        };


        return [
            "alwaysfail" => "required"
        ];
    }


    private $loginRequest = [
        'email' => 'required',
        'password' => 'required'
    ];


    private $registerRequest = [
        'username' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
    ];
}
