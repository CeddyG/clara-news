<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class TagRepository extends QueryBuilderRepository
{
    protected $sTable = 'tag';

    protected $sPrimaryKey = 'id_tag';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news'
    ];

    protected $aFillable = [
        'name_tag'
    ];
    
   
    public function news()
    {
        return $this->belongsToMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'news_tag', 'fk_tag', 'fk_news');
    }


}
