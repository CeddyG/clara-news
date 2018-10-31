<div class="side">
    <h2 class="sidebar-heading">Catégories</h2>
    <p>
        <ul class="category">
            @foreach ($oCategories as $oCategory)
                <li><a href="{{ url('news-category/'.$oCategory->slug_news_category) }}"><i class="icon-check"></i> {{ $oCategory->name_news_category }}</a></li>
            @endforeach
        </ul>
    </p>
</div>