<?php

namespace CeddyG\ClaraNews\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCommentRequest extends FormRequest
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
            'id_news_comment' => 'numeric',
            'fk_news' => 'numeric',
            'name_news_comment' => 'string|max:255',
            'mail_news_comment' => 'string|max:255',
            'text_news_comment' => '',
            'score_news_comment' => 'numeric',
            'created_at' => 'string',
            'updated_at' => 'string'
        ];
    }
}

