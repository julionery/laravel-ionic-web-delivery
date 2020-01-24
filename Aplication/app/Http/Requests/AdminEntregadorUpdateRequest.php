<?php

namespace WebDelivery\Http\Requests;

use WebDelivery\Http\Requests\Request;

class AdminEntregadorUpdateRequest extends Request
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
            'usuario.nome' => 'required|min:3|max:50',
            'telefone' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'cep' => 'required'
        ];
    }
}
