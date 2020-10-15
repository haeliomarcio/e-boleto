<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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

   public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,' . $this->route('id'),
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
