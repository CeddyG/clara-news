<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;
use CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository;

class NewsCategoryController extends Controller
{
    private $oRepository;
    private $oRepositoryText;
    
    public function __construct(NewsCategoryRepository $oNewsCategoryRepository, NewsCategoryTextRepository $oNewsCategoryTextRepository)
    {
        $this->oRepository      = $oNewsCategoryRepository;
        $this->oRepositoryText = $oNewsCategoryTextRepository;
    }

    public function show($slug)
    {
        $oText = $this->oRepositoryText
            ->findByField('slug_news_category', $slug, ['fk_news_category']);        
        
        if ($oText !== null)
        {
            $oCategory = $this->oRepository
                ->getFillFromView('clara-news::index')
                ->find($oText->first()->fk_news_category, 
                    [
                        'title_news_category',
                        'news.users.first_name',
                        'news.users.last_name',  
                        'news.url_image_news',
                        'news.title_news',
                        'news.short_text',
                        'news.news_trans.url_news',
                        'news.created_at'
                    ]
                );
            
            //Get the news
            $oNews = $oCategory->news->map(function ($oItem, $iKey) use ($oCategory) {
                
                $oItem->news_category = $oCategory;
                
                return $oItem;
            });
            
            $oNews = $oNews->sortByDesc('created_at');
            
            $sBreadCrumbsTitle = $oCategory->name_news_category;
            
            return view('clara-news::index', compact('oNews', 'sBreadCrumbsTitle'));
        }
        else
        {
            abort(404);
        }
    }
}
