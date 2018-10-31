<?php
namespace CeddyG\ClaraNews;

use Illuminate\Support\ServiceProvider;

use View;
use CeddyG\ClaraNews\Repositories\NewsRepository;
use CeddyG\ClaraNews\Repositories\NewsCategoryRepository;

/**
 * Description of EntityServiceProvider
 *
 * @author CeddyG
 */
class NewsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishesConfig();
		$this->publishesTranslations();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->publishesView();
        
        $this->buildCategoriesPartial();
        $this->buildLastNewsPartial();
    }
    
    /**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path();
        } 
		else 
		{
            $sPublishPath = base_path();
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara.news.config');  
	}
	
	private function publishesTranslations()
	{
		$sTransPath = __DIR__.'/../resources/lang';

        $this->publishes([
			$sTransPath => resource_path('lang/vendor/clara-news'),
			'clara.news.trans'
		]);
        
		$this->loadTranslationsFrom($sTransPath, 'clara-news');
    }

	private function publishesView()
	{
        $sResources = __DIR__.'/../resources/views';

        $this->publishes([
            $sResources => resource_path('views/vendor/clara-news'),
        ], 'clara.news.views');
        
        $this->loadViewsFrom($sResources, 'clara-news');
	}
    
    private function buildCategoriesPartial()
    {
        View::composer('clara-news::partials.categories', function($view)
        {
            $oCategoryRepository    = new NewsCategoryRepository();
            $oCategories            = $oCategoryRepository
                ->all(['name_news_category', 'slug_news_category']);
            
            $view->with('oCategories', $oCategories);
        });
    }
    
    private function buildLastNewsPartial()
    {
        View::composer('clara-news::partials.last-news', function($view)
        {
            $oRepository    = new NewsRepository();
            $oLastNews            = $oRepository
                ->getFillFromView('clara-news::partials.last-news')
                ->orderBy('created_at', 'desc')
                ->limit(0, 3)
                ->all();
            
            $view->with('oLastNews', $oLastNews);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.news.php', 'clara.news'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.navbar.php', 'clara.navbar'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.news-category.php', 'clara.news-category'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.tag.php', 'clara.tag'
        );
    }
}
