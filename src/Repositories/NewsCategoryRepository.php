<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class NewsCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'news_category';

    protected $sPrimaryKey = 'id_news_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news'
    ];

    protected $aFillable = [
        'name_news_category'
    ];
    
   
    public function news()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'fk_news_category');
    }


}
