<?php

return [
    
    [
        'clara-news::news.news',
        [
            'news'          => 'clara-news::news.list',
            'news-category' => 'clara-news::news.fk_news_category',
            'tag'           => 'clara-news::tag.tag'
        ]
    ]
    
];