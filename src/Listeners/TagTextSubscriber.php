<?php

namespace CeddyG\ClaraNews\Listeners;

use CeddyG\ClaraNews\Repositories\TagTextRepository;

class TagTextSubscriber
{
    private $oRepository;
    
    public function __construct(TagTextRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraNews\Http\Requests\TagTextRequest');
    }

    public function store($oEvent) 
    {
        $aInputs = $oEvent->aInputs['tag_text'];
        
        foreach ($aInputs as $iIdLang => $aInput)
        {
            $aInput['fk_lang']  = $iIdLang;
            $aInput['fk_tag']   = $oEvent->id;
            
            $this->oRepository->updateOrCreate(
                [
                    ['fk_lang', '=', $iIdLang],
                    ['fk_tag', '=', $oEvent->id]
                ], 
                $aInput
            );
        }        
    }
    
    public function delete($oEvent)
    {
        $this->oRepository->deleteWhere([['fk_tag', '=', $oEvent->id]]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\Tag\BeforeStoreEvent',
            'CeddyG\ClaraNews\Listeners\TagTextSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraNews\Events\Tag\AfterStoreEvent',
            'CeddyG\ClaraNews\Listeners\TagTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\Tag\BeforeUpdateEvent',
            'CeddyG\ClaraNews\Listeners\TagTextSubscriber@validate'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\Tag\AfterUpdateEvent',
            'CeddyG\ClaraNews\Listeners\TagTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\Tag\BeforeDestroyEvent',
            'CeddyG\ClaraNews\Listeners\TagTextSubscriber@validate'
        );
    }
}
