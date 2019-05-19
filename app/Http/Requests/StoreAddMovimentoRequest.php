<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddMovimentoRequest extends FormRequest
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
            'matricula' => 'required|unique:aeronaves|max:8'
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}