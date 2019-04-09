<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;

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
        return $this->hasMany('CeddyG\ClaraNews\Repositories\TagTextRepository', 'fk_tag', [['fk_lang', '=', App::getLocale()]]);
    }
}
