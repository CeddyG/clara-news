<?php

namespace CeddyG\ClaraNews\Http\Controllers\Admin;

use CeddyG\Clara\Http\Controllers\ContentManagerController;

use Illuminate\Http\Request;
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
                ->find($id, ['news.id_news', 'news.title_news']);

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
