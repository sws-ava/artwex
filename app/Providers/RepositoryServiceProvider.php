<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Attribute\AttributeRepository::class,
            \App\Repositories\Attribute\EloquentAttribute::class
        );        
		$this->app->singleton(
            \App\Repositories\AttributeValue\AttributeValueRepository::class,
            \App\Repositories\AttributeValue\EloquentAttributeValue::class
        );        
		$this->app->singleton(
            \App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\EloquentCategory::class
        );
        $this->app->singleton(
            \App\Repositories\Page\PageRepository::class,
            \App\Repositories\Page\EloquentPage::class
        );
        $this->app->singleton(
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\EloquentProduct::class
        );
        $this->app->singleton(
            \App\Repositories\Shop\ShopRepository::class,
            \App\Repositories\Shop\EloquentShop::class
        );        
		$this->app->singleton(
            \App\Repositories\Faq\FaqRepository::class,
            \App\Repositories\Faq\EloquentFaq::class
        );        
		$this->app->singleton(
            \App\Repositories\Promocode\PromocodeRepository::class,
            \App\Repositories\Promocode\EloquentPromocode::class
        );        
		$this->app->singleton(
            \App\Repositories\Slider\SliderRepository::class,
            \App\Repositories\Slider\EloquentSlider::class
        );				
		$this->app->singleton(
            \App\Repositories\Idea\IdeaRepository::class,
            \App\Repositories\Idea\EloquentIdea::class
        );		
		$this->app->singleton(
            \App\Repositories\Order\OrderRepository::class,
            \App\Repositories\Order\EloquentOrder::class
        );		
		$this->app->singleton(
            \App\Repositories\Contact\ContactRepository::class,
            \App\Repositories\Contact\EloquentContact::class
        );
    }
}
