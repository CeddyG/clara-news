<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class NewsCategoryTextRepository extends QueryBuilderRepository
{
    protected $sTable = 'news_category_text';

    protected $sPrimaryKey = 'id_news_category_text';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news_category'
    ];

    protected $aFillable = [
        'fk_news_category',
        'fk_lang',
        'name_news_category',
        'slug_news_category'
    ];
    
   
    public function news_category()
    {
        return $this->belongsTo('App\Repositories\NewsCategoryRepository', 'fk_news_category');
    }


}
