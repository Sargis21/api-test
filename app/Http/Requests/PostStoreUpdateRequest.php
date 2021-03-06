<?php

namespace App\Http\Requests;

use App\Exceptions\ErrorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreUpdateRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:5|max:1000',
            'tags' => 'array',
            'tags.*' => 'integer'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ErrorException( $validator->getMessageBag()->first());
    }
}
