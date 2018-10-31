@extends('abricot/layout')

@section('CSS')
    <style>
        .col-news
        {
            max-height: 650px;
        }
        
        @media (min-width: 992px) 
        {
            .col-news
            {
                height: 450px;
                max-height: none;
            }
        }
        
    </style>
@stop

@section('breadcrumbs')
<aside id="colorlib-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumbs text-center">
                <h2>Actualité</h2>
                <p><span><a href="{{ url('/') }}">Accueil</a></span> / <span>{{ $sBreadCrumbsTitle }}</span></p>
            </div>
        </div>
    </div>
</aside>
@stop
@section('content')

<div id="colorlib-container">
    <div class="container">
        <div class="row">
            <div class="col-md-9 content">
                <div class="row row-pb-md">
                    @foreach ($oNews as $oNew)
                        <div class="col-md-6 col-news">
                            <div class="blog-entry">
                                <div class="blog-img">
                                    <a href="{{ url('news/'.$oNew->url_news) }}"><img src="{{ asset($oNew->url_image_news) }}" class="img-responsive" alt="html5 bootstrap template"></a>
                                </div>
                                <div class="desc">
                                    <p class="meta">
                                        <span class="cat"><a href="#">{{ $oNew->news_category->name_news_category }} </a></span>
                                        <span class="date">{{ $oNew->created_at }}</span>
                                        <span class="pos">Par <a href="#">{{ $oNew->users->first_name }}</a></span>
                                    </p>
                                    <h2><a href="{{ url('news/'.$oNew->url_news) }}">{{ $oNew->title_news }}</a></h2>
                                    {!! $oNew->short_text !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                -->
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <!--
                    <div class="side">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" placeholder="Enter any key to search...">
                            <button type="submit" class="btn btn-primary"><i class="icon-search3"></i></button>
                        </div>
                    </div>
                    -->
                    @include('clara-news::partials.categories')
                    @include('clara-news::partials.last-news')

                </div>
            </div>
        </div>
    </div>
</div>
@stop
