<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobs extends FormRequest
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
            'title' => 'required|min:3',
            'description' => 'required|min:6',
            'status' => 'required',
            'date_begin' => 'required',
            'city_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Título',
            'description' => 'Descrição',
            'status' => 'Status',
            'date_begin' => 'Iníco',
            'state_id' => 'Estado',
            'city_id' => 'Cidade',
        ];
    }
}
