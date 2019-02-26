<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class NewsRepository extends QueryBuilderRepository
{
    protected $sTable = 'news';

    protected $sPrimaryKey = 'id_news';
    
    protected $sDateFormatToGet = 'd/m/Y à H:i';
    
    protected $aDates = ['created_at'];
        
    protected $aRelations = [
        'news_category',
		'users',
		'tag'
    ];

    protected $aFillable = [
        'fk_news_category',
		'fk_users',
		'title_news',
		'url_news',
		'text_news',
		'url_image_news',
        'created_at'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'short_text' => [
            'text_news'
        ]
    ];
    
    /**
     * Relations
     */
    
    public function news_category()
    {
        return $this->belongsTo('CeddyG\ClaraNews\Repositories\NewsCategoryRepository', 'fk_news_category');
    }

    public function users()
    {
        return $this->belongsTo('App\Repositories\UserRepository', 'fk_users');
    }

    public function tag()
    {
        return $this->belongsToMany('CeddyG\ClaraNews\Repositories\TagRepository', 'news_tag', 'fk_news', 'fk_tag');
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
    
    public function getShortTextAttribute($oItem)
    {
        if (strlen($oItem->text_news) > 120)
        {
            $oItem->text_news = str_replace('<div>', '', $oItem->text_news);
            $oItem->text_news = str_replace('</div>', '', $oItem->text_news);
            
            $i = 120;
            while ($oItem->text_news[$i] != ' ')
            {
                $i--;
            }
            
            return substr($oItem->text_news, 0, $i).' ...';
        }
        else
        {
            return $oItem->text_news;
        }
    }
}
