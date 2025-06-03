<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestVenda extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $request = [];
        if ($this->method() =="POST" || $this->method() == "PUT"){
            return [
                'numero_da_venda' => 'required',
                'produto_id' => 'required',
                'cliente_id' => 'required',
            ];

        }
        return $request;
    }
}

