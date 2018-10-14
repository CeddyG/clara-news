<?php

namespace CeddyG\ClaraNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'id_tag' => 'numeric',
            'name_tag' => 'string|max:45',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

