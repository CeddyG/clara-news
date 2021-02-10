<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use Illuminate\Http\Request;
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
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $oRequest)
    {
        $this->oRepository->setTransformCustomAttribute(false);
        
        if (!$oRequest->is('api/*'))
        {
            $oItem = $this->oRepository
                ->find($id, ['news_category_text']);

            $sPageTitle = $this->sName;

            return view($this->sPath.'/form',  compact('oItem','sPageTitle'));
        }
        else
        {
            $aInput = $oRequest->all();
            
            if (array_has($aInput, 'column') && count($aInput['column']) > 0)
            {
                $aField = $aInput['column'];
            }
            else
            {
                $aField = ['*'];
            }
            
            $oItem = $this->oRepository
                ->find($id, $aField);
            
            return response()->json($oItem, 200);
        }        
    }
}
