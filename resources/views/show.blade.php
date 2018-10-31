@extends('abricot/layout')

@section('breadcrumbs')
    <aside id="colorlib-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 breadcrumbs text-center">
                    <h2>Blog detail</h2>
                    <p><span><a href="{{ url('/') }}">Accueil</a></span> / <span><a href="{{ url('news-category/'.$oNews->news_category->slug_news_category) }}">{{ $oNews->news_category->name_news_category }} </a></span> / <span>{{ $oNews->title_news }}</span></p>
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
                    <div class="row row-pb-lg">
                        <div class="col-md-12">
                            <div class="blog-entry">
                                <div class="blog-img blog-detail">
                                    <img src="{{ $oNews->url_image_news }}" class="img-responsive" alt="{{ $oNews->title_news }}">
                                </div>
                                <div class="desc">
                                    <p class="meta">
                                        <span class="cat"><a href="#">{{ $oNews->news_category->name_news_category }}</a></span>
                                        <span class="date">{{ $oNews->created_at }}</span>
                                        <span class="pos">Par <a href="#">{{ $oNews->users->first_name }}</a></span>
                                    </p>
                                    <h2>{{ $oNews->title_news }}</h2>
                                    {!! $oNews->text_news !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <!--
                        <div class="side">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Rechercher...">
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
