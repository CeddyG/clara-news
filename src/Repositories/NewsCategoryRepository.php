<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;

class NewsCategoryRepository extends QueryBuilderRepository
{
    protected $sTable = 'news_category';

    protected $sPrimaryKey = 'id_news_category';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news',
        'news_category_text',
        'text'
    ];

    protected $aFillable = [
        
    ];
    
    protected $bTimestamp = true;
    
    public function news()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'fk_news_category');
    }

    public function news_category_text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository', 'fk_news_category');
    }
    
    public function text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository', 'fk_news_category', [['fk_lang', '=', App::getLocale()]]);
    }


    public function setSlugNewsCategoryAttribute($aInputs)
    {
        return str_slug($aInputs['slug_news_category']);
    }
}
