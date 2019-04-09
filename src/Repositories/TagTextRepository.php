<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class TagTextRepository extends QueryBuilderRepository
{
    protected $sTable = 'tag_text';

    protected $sPrimaryKey = 'id_tag_text';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'tag'
    ];

    protected $aFillable = [
        'fk_tag',
        'fk_lang',
        'name_tag'
    ];
    
    protected $bTimestamp = true;    
   
    public function tag()
    {
        return $this->belongsTo('App\Repositories\TagRepository', 'fk_tag');
    }


}
