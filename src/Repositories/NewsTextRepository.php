<?php

namespace CeddyG\ClaraNews\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use Str;

class NewsTextRepository extends QueryBuilderRepository
{
    protected $sTable = 'news_text';

    protected $sPrimaryKey = 'id_news_text';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'news'
    ];

    protected $aFillable = [
        'fk_news',
        'fk_lang',
        'title_news',
        'url_news',
        'text_news',
        'title_meta_news',
        'description_meta_news',
        'token_preview_news'
    ];
    
    protected $aDefaultCreate = [
        'token_preview_news'
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
    
    protected $bTimestamp = true;   
   
    public function news()
    {
        return $this->belongsTo('App\Repositories\NewsRepository', 'fk_news');
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
    
    /**
     * Custom setter 
     */
    
    public function setUrlNewsAttribute($aInputs)
    {
        return Str::slug($aInputs['url_news']);
    }
    
    public function setTokenPreviewNewsAttribute($aInputs)
    {
        return Str::random(60);
    }
}
