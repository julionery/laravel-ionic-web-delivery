<?php

namespace WebDelivery\Http\Requests;

use WebDelivery\Http\Requests\Request;

class AdminProdutoRequest extends Request
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
            'descricao' => 'required',
            'categoria_id' => 'required',
            'preco' => 'required'
        ];
    }
}
