<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraNews\Http\Requests\NewsCommentRequest;
use CeddyG\ClaraNews\Repositories\NewsCommentRepository;
use CeddyG\ClaraNews\Repositories\NewsTextRepository;

class NewsCommentController extends Controller
{
    protected $sEventBeforeStore    = 'CeddyG\ClaraNews\Events\NewsComment\BeforeStoreEvent';
    protected $sEventAfterStore     = 'CeddyG\ClaraNews\Events\NewsComment\AfterStoreEvent';
    
    public function store(
        $slug, 
        NewsCommentRequest $oNewsCommentRequest, 
        NewsCommentRepository $oNewsCommentRepository,
        NewsTextRepository $oNewsTextRepository
    )
    {
        $oText = $oNewsTextRepository
            ->findByField('url_news', $slug, ['fk_news']);
        
        if ($oText->isEmpty())
        {
            $oText = $oNewsTextRepository
                ->findByField('token_preview_news', $slug, ['fk_news']);
        }
        
        if ($oText->isNotEmpty())
        {
            $aInputs = $oNewsCommentRequest->all();
            $aInputs['fk_news'] = $oText->first()->fk_news;
            
            if ($this->sEventBeforeStore != '')
            {
                event(new $this->sEventBeforeStore($aInputs));
            }

            $id = $oNewsCommentRepository->create($aInputs);

            if ($this->sEventAfterStore != '')
            {
                event(new $this->sEventAfterStore($id, $aInputs));
            }

            return redirect('news/'.$slug);
        }
        else
        {
            abort(404);
        }
    }
}
