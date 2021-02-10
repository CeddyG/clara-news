<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use Illuminate\Http\Request;
use CeddyG\ClaraNews\Repositories\NewsRepository;

class NewsController extends ContentManagerController
{
    protected $sEventBeforeStore    = \CeddyG\ClaraNews\Events\News\BeforeStoreEvent::class;
    protected $sEventAfterStore     = \CeddyG\ClaraNews\Events\News\AfterStoreEvent::class;
    protected $sEventBeforeUpdate   = \CeddyG\ClaraNews\Events\News\BeforeUpdateEvent::class;
    protected $sEventAfterUpdate    = \CeddyG\ClaraNews\Events\News\AfterUpdateEvent::class;
    protected $sEventBeforeDestroy  = \CeddyG\ClaraNews\Events\News\BeforeDestroyEvent::class;
    
    public function __construct(NewsRepository $oRepository)
    {
        $this->sPath            = 'clara-news::admin.news';
        $this->sPathRedirect    = 'admin/news';
        $this->sName            = __('clara-news::news.news');
        
        $this->oRepository  = $oRepository;
        $this->sRequest     = 'CeddyG\ClaraNews\Http\Requests\NewsRequest';
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
                ->getFillFromView($this->sPath.'/form')
                ->find($id, ['tag.id_tag', 'tag.title_tag', 'news_category.title_news_category']);

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
