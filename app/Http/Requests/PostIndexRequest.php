<?php

namespace App\Http\Requests;

use App\Exceptions\ErrorException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class PostIndexRequest extends FormRequest
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
            'offset' => 'required',
            'limit' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ErrorException( $validator->getMessageBag()->first());
    }
}
