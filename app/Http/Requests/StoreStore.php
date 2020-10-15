<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStore extends FormRequest
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
            'brand_id' => 'required',
            'information' => 'required|min:10',
            'address' => 'required|min:6',
            'city_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'Marca',
            'information' => 'Informações',
            'address' => 'Endereço',
            'city_id' => 'Cidade',
            'lat' => 'Latitude',
            'lng' => 'Longitude',
        ];
    }
}
