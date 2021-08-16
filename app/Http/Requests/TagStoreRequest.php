<?php

namespace App\Http\Requests;

use App\Exceptions\ErrorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100|unique:tags'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ErrorException( $validator->getMessageBag()->first());
    }
}
