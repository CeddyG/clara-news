<div class="side">
    <h2 class="sidebar-heading">Tags</h2>
    <p>
        <ul class="category">
            @foreach ($oTags as $oTag)
                <li><i class="icon-check"></i> {{ $oTag->title_tag }}</li>
            @endforeach
        </ul>
    </p>
</div>