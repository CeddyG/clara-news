<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use App;
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
            ->findByField('enable_news', 1, ['short_text', 'news_category.title_news_category', 'news_trans.url_news', 'title_news']);
        
        $sBreadCrumbsTitle = 'News';
        
        return view('clara-news::index', compact('oNews', 'sBreadCrumbsTitle'));       
    }

    public function show($slug)
    {
        $oText = $this->oRepositoryText
            ->findByField('url_news', $slug, ['fk_news', 'fk_lang']);
        
        if ($oText->isEmpty())
        {
            $oText = $this->oRepositoryText
                ->findByField('token_preview_news', $slug, ['fk_news', 'fk_lang']);
        }
        
        if ($oText->isNotEmpty())
        {
            App::setLocale(config('clara.lang.iso')[$oText->first()->fk_lang]);
            
            $oNews = $this->oRepository
                ->getFillFromView('clara-news::show')
                ->find(
                    $oText->first()->fk_news, 
                    [
                        'title_news',
                        'enable_news',
                        'news_trans.text_news',
                        'news_trans.url_news',
                        'news_trans.title_meta_news',
                        'news_trans.description_meta_news',
                        'news_category.title_news_category'
                    ]
            );
            
            if ($oNews->enable_news != 1 && $slug == $oNews->news_trans->first()->url_news)
            {
                abort(404);
            }
            
            $sTitlePage         = $oNews->news_trans->first()->title_meta_news;
            $sDescriptionPage   = $oNews->news_trans->first()->description_meta_news;

            return view('clara-news::show', compact('oNews', 'sTitlePage', 'sDescriptionPage'));
        }
        else
        {
            
            abort(404);
        }
    }
}
