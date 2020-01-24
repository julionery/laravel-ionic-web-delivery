<?php

namespace WebDelivery\Http\Requests;


use Illuminate\Http\Request as HttpRequest;

class CheckoutRequest extends Request
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
    public function rules(HttpRequest $request)
    {
        $rules = [
            'cupom_code' => 'exists:cupoms,codigo,usado,0',
        ];
        $this->buildRulesItems(0, $rules);
        $itens = $request->get('items', []);
        $itens = !is_array($itens) ? [] : $itens;

        foreach ($itens as $key => $val)
        {
         $this->buildRulesItems($key, $rules);
        }
        return $rules;
    }

    public function buildRulesItems($key, array &$rules)
    {
        $rules["items.$key.produto_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }
}
