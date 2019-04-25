<?php

namespace CeddyG\ClaraNews\Listeners;

use CeddyG\ClaraNews\Repositories\NewsRepository;

class NewsSubscriber
{
    private $oRepository;
    
    public function __construct(NewsRepository $oRepository)
    {
        $this->oRepository = $oRepository;
    }
    
    public function unsync($oEvent)
    {
        $this->oRepository->update($oEvent->id, ['tag' => []]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraNews\Events\News\BeforeDestroyEvent',
            'CeddyG\ClaraNews\Listeners\NewsSubscriber@unsync'
        );
    }
}
