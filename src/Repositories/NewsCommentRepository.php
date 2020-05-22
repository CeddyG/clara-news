<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class NewsCommentRepository extends QueryBuilderRepository
{
    protected $sTable = 'news_comment';

    protected $sPrimaryKey = 'id_news_comment';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news'
    ];

    protected $aFillable = [
        'fk_news',
        'name_news_comment',
        'mail_news_comment',
        'text_news_comment',
        'score_news_comment'
    ];
    
    protected $bTimestamp = true;

   
    public function news()
    {
        return $this->belongsTo('App\Repositories\NewsRepository', 'fk_news');
    }


}
