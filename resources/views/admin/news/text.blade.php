{!! BootForm::text(__('clara-news::news.title_news'), 'text['.$iIdView.'][title_new]s') !!}
{!! BootForm::text(__('clara-news::news.url_news'), 'text['.$iIdView.'][url_news']) !!}
{!! BootForm::textarea(__('clara-news::news.text_news'), 'text['.$iIdView.'][text_news]')->class('ckeditor') !!}