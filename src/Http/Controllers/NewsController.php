<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraNews\Repositories\NewsRepository;
use CeddyG\ClaraNews\Repositories\NewsTextRepository;

class NewsController extends Controller
{
    private $oRepository;
    private $oRepositoryText;
    
    public function __construct(NewsRepository $oNewsRepository, NewsTextRepository $oNewsTextRepository)
    {
        $this->oRepository      = $oNewsRepository;
        $this->oRepositoryText  = $oNewsTextRepository;
    }
    
    public function index()
    {
        $oNews = $this->oRepository
            ->getFillFromView('clara-news::index')
            ->orderBy('created_at', 'desc')
            ->all(['short_text', 'news_category.title_news_category', 'news_trans.url_news', 'title_news']);
        
        $sBreadCrumbsTitle = 'News';
        
        return view('clara-news::index', compact('oNews', 'sBreadCrumbsTitle'));       
    }

    public function show($slug)
    {
        $oText = $this->oRepositoryText
            ->findByField('url_news', $slug, ['fk_news']);
        
        if ($oText->isNotEmpty())
        {
            $oNews = $this->oRepository
                ->getFillFromView('clara-news::show')
                ->find(
                    $oText->first()->fk_news, 
                    [
                        'title_news',
                        'news_trans.text_news',
                        'news_category.title_news_category'
                    ]
            );

            return view('clara-news::show', compact('oNews'));
        }
        else
        {
            abort(404);
        }
    }
}
