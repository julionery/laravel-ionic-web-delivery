<?php

namespace WebDelivery\Http\Requests;

use WebDelivery\Http\Requests\Request;

class AdminEmpresaRequest extends Request
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
            'razao_social'=> 'required|min:3',
            'nome_fantasia'=> 'required|min:3',
            'cnpj' => 'required|min:14'
        ];
    }
}
