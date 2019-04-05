<?php

namespace CeddyG\ClaraNews\Listeners;

use CeddyG\ClaraNews\Repositories\NewsTextRepository;

class NewsTextSubscriber
{
    private $oRepository;
    
    public function __construct(NewsTextRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraNews\Http\Requests\NewsTextRequest');
    }

    public function store($oEvent) 
    {
        $aInputs = $oEvent->aInput->text;
        
        foreach ($aInputs as $iIdLang => $aInput)
        {
            $aInput['fk_lang']  = $iIdLang;
            $aInput['fk_news']  = $oEvent->id;
            
            $this->oRepository->updateOrCreate(['fk_lang', 'fk_news'], $oEvent->aInput);
        }        
    }
    
    public function delete($oEvent)
    {
        $this->oRepository->deleteWhere([['fk_news', '=', $oEvent->id]]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\BeforeStoreEvent',
            'CeddyG\ClaraNews\Listeners\NewsTextSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\AfterStoreEvent',
            'CeddyG\ClaraNews\Listeners\NewsTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\BeforeUpdateEvent',
            'CeddyG\ClaraNews\Listeners\NewsTextSubscriber@validate'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\AfterUpdateEvent',
            'CeddyG\ClaraNews\Listeners\NewsTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\BeforeDestroyEvent',
            'CeddyG\ClaraNews\Listeners\NewsTextSubscriber@validate'
        );
    }
}
