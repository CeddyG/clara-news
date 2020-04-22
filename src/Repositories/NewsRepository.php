<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;
use ClaraLang;

class NewsRepository extends QueryBuilderRepository
{
    protected $sTable = 'news';

    protected $sPrimaryKey = 'id_news';
    
    protected $sDateFormatToGet = 'd/m/Y à H:i';
    
    protected $aDates = ['created_at'];
        
    protected $aRelations = [
        'news_category',
        'users',
        'tag',
        'news_text',
        'news_trans'
    ];

    protected $aFillable = [
        'fk_news_category',
        'fk_users',
        'url_image_news',
        'created_at'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'title_news' => [
            'news_trans.title_news'
        ],
        'short_text' => [
            'news_trans.text_news'
        ]
    ];
    
    protected $bTimestamp = true;
    
    /**
     * Relations
     */
    
    public function news_category()
    {
        return $this->belongsTo('CeddyG\ClaraNews\Repositories\NewsCategoryRepository', 'fk_news_category');
    }

    public function users()
    {
        return $this->belongsTo('CeddyG\ClaraSentinel\Repositories\UserRepository', 'fk_users');
    }

    public function tag()
    {
        return $this->belongsToMany('CeddyG\ClaraNews\Repositories\TagRepository', 'news_tag', 'fk_news', 'fk_tag');
    }

    public function news_text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsTextRepository', 'fk_news');
    }

    public function news_trans()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsTextRepository', 'fk_news', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
    
    /**
     * Custom getter
     */
    
    public function getTitleNewsAttribute($oItem)
    {
        return $oItem->news_trans->first()->title_news;
    }
    
    public function getShortTextAttribute($oItem)
    {
        if (strlen($oItem->news_trans->first()->text_news) > 120)
        {
            $sShortText = strip_tags($oItem->news_trans->first()->text_news);
            
            $i = 120;
            while ($sShortText[$i] != ' ')
            {
                $i--;
            }
            
            return substr($sShortText, 0, $i).' ...';
        }
        else
        {
            return $oItem->news_trans->first()->text_news;
        }
    }
}
