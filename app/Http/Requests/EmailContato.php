<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailContato extends FormRequest
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
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'telefone' => 'required|min:6',
            'cidade' => 'required',
            'estado' => 'required',
            'sede' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'sede' => 'Sede',
            'assunto' => 'Assunto',
            'mensagem' => 'Mensagem',
        ];
    }
}
