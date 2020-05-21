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
        'news_active',
        'news_category_text',
        'news_category_trans'
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
            'news_category_trans.name_news_category'
        ]
    ];
    
    protected $bTimestamp = true;
    
    public function news()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'fk_news_category');
    }
    
    public function news_active()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'fk_news_category', [['enable_news', '=', 1]]);
    }

    public function news_category_text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository', 'fk_news_category');
    }
    
    public function news_category_trans()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository', 'fk_news_category', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
    
    public function getTitleNewsCategoryAttribute($oItem)
    {
        return $oItem->news_category_trans->first()->name_news_category;
    }
}
