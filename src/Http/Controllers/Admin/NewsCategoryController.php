<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;

class NewsCategoryController extends ContentManagerController
{
    protected $sEventBeforeStore    = \CeddyG\ClaraNews\Events\NewsCategory\BeforeStoreEvent::class;
    protected $sEventAfterStore     = \CeddyG\ClaraNews\Events\NewsCategory\AfterStoreEvent::class;
    protected $sEventBeforeUpdate   = \CeddyG\ClaraNews\Events\NewsCategory\BeforeUpdateEvent::class;
    protected $sEventAfterUpdate    = \CeddyG\ClaraNews\Events\NewsCategory\AfterUpdateEvent::class;
    protected $sEventBeforeDestroy  = \CeddyG\ClaraNews\Events\NewsCategory\BeforeDestroyEvent::class;
    
    public function __construct(NewsCategoryRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.news-category';
        $this->sPathRedirect    = 'admin/news-category';
        $this->sName            = __('clara-news::news-category.news_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\NewsCategoryRequest';
    }
}
