<?php

namespace CeddyG\ClaraNews\Listeners;

use CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository;

class NewsCategoryTextSubscriber
{
    private $oRepository;
    
    public function __construct(NewsCategoryTextRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraNews\Http\Requests\NewsCategoryTextRequest');
    }

    public function store($oEvent) 
    {
        $aInputs = $oEvent->aInputs['news_category_text'];
        
        foreach ($aInputs as $iIdLang => $aInput)
        {
            $aInput['fk_lang']  = $iIdLang;
            $aInput['fk_news_category']   = $oEvent->id;
            
            $this->oRepository->updateOrCreate(
                [
                    ['fk_lang', '=', $iIdLang],
                    ['fk_news_category', '=', $oEvent->id]
                ], 
                $aInput
            );
        }
    }
    
    public function delete($oEvent)
    {
        $this->oRepository->deleteWhere([['fk_news_category', '=', $oEvent->id]]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\NewsCategory\BeforeStoreEvent',
            'CeddyG\ClaraNews\Listeners\NewsCategoryTextSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraNews\Events\NewsCategory\AfterStoreEvent',
            'CeddyG\ClaraNews\Listeners\NewsCategoryTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\NewsCategory\BeforeUpdateEvent',
            'CeddyG\ClaraNews\Listeners\NewsCategoryTextSubscriber@validate'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\NewsCategory\AfterUpdateEvent',
            'CeddyG\ClaraNews\Listeners\NewsCategoryTextSubscriber@store'
        );
        
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\NewsCategory\BeforeDestroyEvent',
            'CeddyG\ClaraNews\Listeners\NewsCategoryTextSubscriber@deletes'
        );
    }
}
