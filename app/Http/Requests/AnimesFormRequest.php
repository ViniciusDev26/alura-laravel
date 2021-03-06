<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimesFormRequest extends FormRequest
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
            'name' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tá esquecendo o campo nome, brow',
            'name.min' => 'Descreve mais o titulo, brother',

            'required' => 'Preencha todos o campos obrigatórios!!',
        ];
    }
}
