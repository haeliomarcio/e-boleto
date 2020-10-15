<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCurriculumStore extends FormRequest
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
            'name' => 'required',
            'cpf' => 'required|min:14|cpf',
            'telephone' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'address' => 'required',
            'number_address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,doc, docx',
            'jobs_deployment_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'cpf' => 'CPF',
            'telephone' => 'Telefone',
            'email' => 'E-mail',
            'cep' => 'CEP',
            'address' => 'Endereço',
            'number_address' => 'Número',
            'district' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'Estado',
            'description' => 'Descrição',
            'file' => 'Currículo',
        ];
    }
}
