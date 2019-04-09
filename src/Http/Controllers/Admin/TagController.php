<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\TagRepository;

class TagController extends ContentManagerController
{
    protected $sEventBeforeStore    = \CeddyG\ClaraNews\Events\Tag\BeforeStoreEvent::class;
    protected $sEventAfterStore     = \CeddyG\ClaraNews\Events\Tag\AfterStoreEvent::class;
    protected $sEventBeforeUpdate   = \CeddyG\ClaraNews\Events\Tag\BeforeUpdateEvent::class;
    protected $sEventAfterUpdate    = \CeddyG\ClaraNews\Events\Tag\AfterUpdateEvent::class;
    protected $sEventBeforeDestroy  = \CeddyG\ClaraNews\Events\Tag\BeforeDestroyEvent::class;
    
    public function __construct(TagRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.tag';
        $this->sPathRedirect    = 'admin/tag';
        $this->sName            = __('clara-news::tag.tag');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\TagRequest';
    }
}
