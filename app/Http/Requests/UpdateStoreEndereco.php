<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreEndereco extends FormRequest
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
            'cep' => "required|min:8|max:8",
            'logradouro' => "required",
            'bairro' => "required",
            'complemento' => "required",
            'numero' => "required",
            'cidade' => "required",
            'estado' => "required",
            'isPrimary' => "required",
            'clients_id' => "required"
        ];
    }
}
