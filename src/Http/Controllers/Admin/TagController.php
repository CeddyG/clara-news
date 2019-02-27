<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\TagRepository;

class TagController extends ContentManagerController
{
    public function __construct(TagRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.tag';
        $this->sPathRedirect    = 'admin/tag';
        $this->sName            = __('clara-news::tag.tag');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\TagRequest';
    }
}
