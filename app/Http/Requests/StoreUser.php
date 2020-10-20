<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
        return [
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'type' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'name' => 'Nome',
            'password' => 'Senha',
            'password_confirmation' => 'Confirma Senha',
            'type' => 'Perfil',
        ];
    }
}
