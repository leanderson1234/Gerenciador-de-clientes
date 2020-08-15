<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreClient extends FormRequest
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
        $id = $this->segment(2);
        return [
            'nome_empresa' => "required|unique:clients,nome_empresa,id,$id|",
            'email' => "required|unique:clients,email,id,$id|email:rfc,dns",
            'cnpj' => "required|unique:clients,cnpj,id,$id|min:14|max:14",
            'telefone' => "required|min:8",
            'nome_responsavel' => "required"
        ];
    }
}
