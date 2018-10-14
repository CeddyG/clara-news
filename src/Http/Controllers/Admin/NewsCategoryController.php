<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use App\Http\Controllers\ContentManagerController;

use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;

class NewsCategoryController extends ContentManagerController
{
    public function __construct(NewsCategoryRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.news-category';
        $this->sPathRedirect    = 'admin/news-category';
        $this->sName            = __('clara-news::news-category.news_category');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\NewsCategoryRequest';
    }
}
