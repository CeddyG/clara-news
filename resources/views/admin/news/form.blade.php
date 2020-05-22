@extends('admin/dashboard')

@section('CSS')
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}

    <style>
        .view-action
        {
            text-align: right;
            margin-bottom: 15px;
        }
        
        .select2
        {
            width: 100% !important
        }
        
        .input-group
        {
            width: 100% !important
        }
        
        .input-group-addon:hover
        {
            color: black;
        }
    </style>
    
    <!-- YesNoBtn -->
    {!! Html::style('adminlte/css/alt/yesno-btn.css') !!}
    
    @include('clara-library::admin.partials.css')
@stop

@section('content')
    @if(isset($oItem))
    <div class="row">
        <div class="col-sm-6">
                <div class="view-action">
                    Voir la version 
                    <div class="btn-group">
                        <a class="btn btn-info" href="{{ url('news/'.$oItem->news_text->first()->token_preview_news) }}" target="_blank">
                            {{ array_values(ClaraLang::getActiveLang())[0] }}
                        </a>
                        @if (count(ClaraLang::getActiveLang()) > 0)
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @foreach (ClaraLang::getActiveLang() as $iIdLang => $sLang)
                                @if ($loop->first)
                                    @continue
                                @endif

                                <li><a href="{{ url('news/'.$oItem->news_text->firstWhere('fk_lang', $iIdLang)->token_preview_news) }}" target="_blank">{{ $sLang }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info">	
                <div class="box-header with-border">
                    @if(isset($oItem))
                        <h3 class="box-title">Modification</h3>
                    @else
                        <h3 class="box-title">Ajouter</h3>
                    @endif
                </div>
                <div class="box-body">
                    @if(isset($oItem))
                        @php $oItem->news_text = $oItem->news_text->keyBy('fk_lang')->toArray() @endphp
                        
                        {!! BootForm::open()->action( route('admin.news.update', $oItem->id_news) )->put() !!}
                        {!! BootForm::bind($oItem) !!}
                    @else
                        {!! BootForm::open()->action( route('admin.news.store') )->post() !!}
                    @endif
                        
                        @if(isset($oItem))
                            {!! BootForm::select(__('clara-news::news-category.news_category'), 'fk_news_category')
                                ->class('select2')
                                ->options([$oItem->fk_news_category => $oItem->news_category->title_news_category])
                                ->data([
                                    'url-select'    => route('admin.news-category.select.ajax'), 
                                    'url-create'    => route('admin.news-category.create'),
                                    'field'         => 'news_category_trans.name_news_category'
                            ]) !!}
                        @else
                            {!! BootForm::select(__('clara-news::news-category.news_category'), 'fk_news_category')
                                ->class('select2')
                                ->data([
                                    'url-select'    => route('admin.news-category.select.ajax'), 
                                    'url-create'    => route('admin.news-category.create'),
                                    'field'         => 'news_category_trans.name_news_category'
                            ]) !!}
                        @endif

                        @if(isset($oItem) && !empty($oItem->tag))
                            {!! BootForm::select(__('clara-news::tag.tag'), 'tag')
                                ->class('select2')
                                ->options($oItem->tag->pluck('title_tag', 'id_tag')->toArray())
                                ->select($oItem->tag->pluck('id_tag')->toArray())
                                ->multiple()
                                ->data([
                                    'url-select'    => route('admin.tag.select.ajax'), 
                                    'url-create'    => route('admin.tag.create'),
                                    'field'         => 'tag_trans.name_tag'
                            ]) !!}
                        @else
                            {!! BootForm::select(__('clara-news::tag.tag'), 'tag')
                                ->class('select2')
                                ->multiple()
                                ->data([
                                    'url-select'    => route('admin.tag.select.ajax'), 
                                    'url-create'    => route('admin.tag.create'),
                                    'field'         => 'tag_trans.name_tag'
                            ]) !!}
                        @endif

                        {!! BootForm::viewTabPane('clara-news::admin.news.text', ClaraLang::getActiveLang()) !!}
                        {!! BootForm::yesNo(__('clara-news::news.enable_news'), 'enable_news') !!}
                        
                        {!! BootForm::text(__('clara-news::news.url_image_news'), 'url_image_news')
							->class('form-control fileinput-element') !!}
                        
                    {!! BootForm::submit('Envoyer', 'btn-primary')->addClass('pull-right') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        </div>
        
        @if(isset($oItem) && !is_array($oItem->news_comment))
        <div class="col-sm-6">
            <div class="box box-info">	
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('clara-news::news-comment.news_comment') }}</h3>
                </div>
                <div class="box-body">
                    @foreach ($oItem->news_comment as $oComment)
                    <div class="post">
                        <div class="user-block">
                              <span class="username">
                                <span>{{ $oComment->name_news_comment }}</span>
                              </span>
                            <span class="description"><a href="mailto:{{ $oComment->mail_news_comment }}">{{ $oComment->mail_news_comment }}</a> - {{ $oComment->created_at }}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            {{ $oComment->text_news_comment }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('clara-library::admin.partials.modal')
@stop

@section('JS')
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <script>
        $(document).ready(function() {
            $('.select2').wrap('<div class="input-group input-group-select2"></div>');
            $( ".input-group-select2" ).each(function () {
                var url = $(this).find('.select2').attr(('data-url-create'));
                $(this).prepend('<a href="'+ url +'" target="_blank" class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></a>');
            });
            
            $('.select2').select2({
                ajax: {
                    url: function () {
                        return $(this).attr('data-url-select');
                    },
                    headers: {
                        "Authorization": "Bearer {{ Sentinel::getUser()->api_token }}"
                    },
                    dataType: 'json',
                    delay: 10,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            field: $(this).attr('data-field'),
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        params.page = params.page || 1;
                
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count 
                }
                        };
                    },
                    cache: true
                },
                them: 'bootstrap'
            });
        });
    </script> 
    
    @include('clara-library::admin.partials.script')

    {!! Html::script('bower_components/ckeditor/ckeditor.js') !!}
    
    <script>
        $(function () {
            CKEDITOR.config.allowedContent = true ;
            CKEDITOR.config.extraPlugins = 'justify,colorbutton,colordialog';
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('.ckeditor');
        });
    </script>

@stop