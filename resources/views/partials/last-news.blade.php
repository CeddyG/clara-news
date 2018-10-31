<div class="side">
    <h2 class="sidebar-heading">Derniers articles</h2>
    @foreach ($oLastNews as $oNew)
        <div class="f-blog">
            <a href="{{ url('news/'.$oNew->url_news) }}" class="blog-img" style="background-image: url({{ asset($oNew->url_image_news) }});">
            </a>
            <div class="desc">
                <h3><a href="{{ url('news/'.$oNew->url_news) }}">{{ $oNew->title_news }}</a></h3>
                <p class="admin"><span>{{ $oNew->created_at }}</span></p>
            </div>
        </div>
        @if ($loop->iteration == 3)
            @break
        @endif
    @endforeach
</div>