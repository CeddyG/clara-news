<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;
use ClaraLang;

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
        'id_news_category'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'title_news_category' => [
            'text.name_news_category'
        ]
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
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository', 'fk_news_category', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }


    public function setSlugNewsCategoryAttribute($aInputs)
    {
        return str_slug($aInputs['slug_news_category']);
    }
    
    public function getTitleNewsCategoryAttribute($oItem)
    {
        return $oItem->text->first()->name_news_category;
    }
}
