<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraNews\Repositories\NewsRepository;

class NewsController extends Controller
{
    private $oRepository;
    
    public function __construct(NewsRepository $oNewsRepository)
    {
        $this->oRepository = $oNewsRepository;
    }
    
    public function index()
    {
        $oNews = $this->oRepository
            ->getFillFromView('clara-news::index')
            ->orderBy('created_at', 'desc')
            ->all(['short_text']);
        
        $sBreadCrumbsTitle = 'News';
        
        return view('clara-news::index', compact('oNews', 'sBreadCrumbsTitle'));       
    }

    public function show($slug)
    {
        $oNews = $this->oRepository
            ->getFillFromView('clara-news::show')
            ->findByField('url_news', $slug);
        
        if ($oNews !== null)
        {
            $oNews = $oNews->first();

            return view('clara-news::show', compact('oNews'));
        }
        else
        {
            abort(404);
        }
    }
}
