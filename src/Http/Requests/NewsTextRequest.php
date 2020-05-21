<?php

namespace CeddyG\ClaraNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsTextRequest extends FormRequest
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
            'id_news_text' => 'numeric',
            'fk_news' => 'numeric',
            'fk_lang' => 'numeric',
            'title_news' => 'string|max:255',
            'url_news' => 'string|max:255',
            'text_news' => '',
            'title_meta_news' => 'string|max:255|nullable',
            'description_meta_news' => '',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

