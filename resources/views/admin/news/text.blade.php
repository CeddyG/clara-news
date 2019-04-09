{!! BootForm::text(__('clara-news::news.title_news'), 'news_text['.$iIdView.'][title_new]s') !!}
{!! BootForm::text(__('clara-news::news.url_news'), 'news_text['.$iIdView.'][url_news']) !!}
{!! BootForm::textarea(__('clara-news::news.text_news'), 'news_text['.$iIdView.'][text_news]')->class('ckeditor') !!}