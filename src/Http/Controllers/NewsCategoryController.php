<?php

namespace CeddyG\ClaraNews\Http\Controllers;

use App\Http\Controllers\Controller;

use App;
use Illuminate\Support\Collection;
use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;
use CeddyG\ClaraNews\Repositories\NewsCategoryTextRepository;

class NewsCategoryController extends Controller
{
    private $oRepository;
    private $oRepositoryText;
    
    public function __construct(NewsCategoryRepository $oNewsCategoryRepository, NewsCategoryTextRepository $oNewsCategoryTextRepository)
    {
        $this->oRepository      = $oNewsCategoryRepository;
        $this->oRepositoryText  = $oNewsCategoryTextRepository;
    }

    public function show($slug)
    {
        $oText = $this->oRepositoryText
            ->findByField('slug_news_category', $slug, ['fk_news_category', 'fk_lang']);        
        
        if ($oText !== null)
        {
            App::setLocale(config('clara.lang.iso')[$oText->first()->fk_lang]);
            $oCategory = $this->oRepository
                ->getFillFromView('clara-news::index')
                ->find($oText->first()->fk_news_category, 
                    [
                        'title_news_category',
                        'news_active.users.first_name',
                        'news_active.users.last_name',  
                        'news_active.url_image_news',
                        'news_active.title_news',
                        'news_active.short_text',
                        'news_active.news_trans.url_news',
                        'news_active.created_at'
                    ]
                );
            
            //Get the news
            if ($oCategory->news_active instanceof Collection )
            {
                $oNews = $oCategory->news_active->map(function ($oItem, $iKey) use ($oCategory) {

                    $oItem->news_category = $oCategory;

                    return $oItem;
                });

                $oNews = $oNews->sortByDesc('created_at');
            }
            else
            {
                $oNews = collect();
            }
            
            $sBreadCrumbsTitle = $oCategory->title_news_category;
            
            return view('clara-news::index', compact('oNews', 'sBreadCrumbsTitle'));
        }
        else
        {
            abort(404);
        }
    }
}
