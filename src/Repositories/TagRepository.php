<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;
use ClaraLang;

class TagRepository extends QueryBuilderRepository
{
    protected $sTable = 'tag';

    protected $sPrimaryKey = 'id_tag';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news',
        'tag_text',
        'text'
    ];

    protected $aFillable = [
        'id_tag'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'title_tag' => [
            'text.name_tag'
        ]
    ];
    
    protected $bTimestamp = true;    
   
    public function news()
    {
        return $this->belongsToMany('CeddyG\ClaraNews\Repositories\NewsRepository', 'news_tag', 'fk_tag', 'fk_news');
    }

    public function tag_text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\TagTextRepository', 'fk_tag');
    }

    public function text()
    {
        return $this->hasMany('CeddyG\ClaraNews\Repositories\TagTextRepository', 'fk_tag', [['fk_lang', '=', ClaraLang::getIdByCode(App::getLocale())]]);
    }
    
    public function getTitleTagAttribute($oItem)
    {
        return $oItem->text->first()->name_tag;
    }
}
