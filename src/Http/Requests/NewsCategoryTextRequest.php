<?php

namespace CeddyG\ClaraNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCategoryTextRequest extends FormRequest
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
            'id_news_category_text' => 'numeric',
            'fk_news_category' => 'numeric',
            'fk_lang' => 'numeric',
            'name_news_category' => 'string|max:255',
            'slug_news_category' => 'string|max:255',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

