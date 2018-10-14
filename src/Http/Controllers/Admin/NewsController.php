<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\NewsRepository;

class NewsController extends ContentManagerController
{
    public function __construct(NewsRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.news';
        $this->sPathRedirect    = 'admin/news';
        $this->sName            = __('clara-news::news.news');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\NewsRequest';
    }
}
