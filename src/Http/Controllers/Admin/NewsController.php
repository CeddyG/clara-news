<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\NewsRepository;

class NewsController extends ContentManagerController
{
    protected $sEventBeforeStore    = CeddyG\ClaraNews\Events\News\BeforeStoreEvent::class;
    protected $sEventAfterStore     = CeddyG\ClaraNews\Events\News\AfterStoreEvent::class;
    protected $sEventBeforeUpdate   = CeddyG\ClaraNews\Events\News\BeforeUpdateEvent::class;
    protected $sEventAfterUpdate    = CeddyG\ClaraNews\Events\News\AfterUpdateEvent::class;
    protected $sEventBeforeDestroy  = CeddyG\ClaraNews\Events\News\BeforeDestroyEvent::class;
    
    public function __construct(NewsRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.news';
        $this->sPathRedirect    = 'admin/news';
        $this->sName            = __('clara-news::news.news');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\NewsRequest';
    }
}
