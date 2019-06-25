<?php

namespace FleetCart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
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
        $rules = [
//            'token' => 'required|string',
            'codeERP' => 'required|string',
            'name' => 'required|min:1',
            'description' => 'required|min:1',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
/*                        'game_id' => 'required|integer|exists:games,id', //должен существовать. Можно вот так: unique:games,id,' . $this->route('game'),
                        'title' => [
                            'required',
                            Rule::unique('games')->ignore($this->title, 'title') //должен быть уникальным, за исключением себя же
                        ]*/
                    ]; // и берем все остальные правила
            // case 'PATCH':
            case 'DELETE':
                return [
//                    'game_id' => 'required|integer|exists:games,id'
                ];
        }
    }
}
