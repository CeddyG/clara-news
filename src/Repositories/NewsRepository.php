<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;

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
        return $this->hasMany('CeddyG\ClaraNews\Repositories\NewsTextRepository', 'fk_news', [['fk_lang', '=', App::getLocale()]]);
    }
}
