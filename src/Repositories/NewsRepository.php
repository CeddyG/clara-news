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
		'text'
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
            'text.title_news'
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

    public function text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsTextRepository', 'fk_news', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
    
    /**
     * Custom setter 
     */
    
    public function setUrlNewsAttribute($aInputs)
    {
        return str_slug($aInputs['url_news']);
    }
    
    /**
     * Custom getter
     */
    
    public function getTitleNewsAttribute($oItem)
    {
        return $oItem->text->first()->title_news;
    }
    
    public function getShortTextAttribute($oItem)
    {
        if (strlen($oItem->text->first()->text_news) > 120)
        {
            $oItem->text->first()->text_news = strip_tags($oItem->text->first()->text_news);
            
            $i = 120;
            while ($oItem->text->first()->text_news[$i] != ' ')
            {
                $i--;
            }
            
            return substr($oItem->text->first()->text_news, 0, $i).' ...';
        }
        else
        {
            return $oItem->text->first()->text_news;
        }
    }
}
