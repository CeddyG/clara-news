<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;

class NewsCategoryController extends Controller
{
    private $oRepository;
    
    public function __construct(NewsCategoryRepository $oNewsCategoryRepository)
    {
        $this->oRepository = $oNewsCategoryRepository;
    }

    public function show($slug)
    {
        $oCategory = $this->oRepository
            ->getFillFromView('clara-news::index')
            ->findByField('slug_news_category', $slug, 
                [
                    'news.users.first_name',
                    'news.users.last_name',  
                    'news.url_news',
                    'news.url_image_news',
                    'news.title_news',
                    'news.short_text',
                    'news.created_at'
                ]
            );
        
        if ($oCategory !== null)
        {
            $oCategory = $oCategory->first();
            
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
