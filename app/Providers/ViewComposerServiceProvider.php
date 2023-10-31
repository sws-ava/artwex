<?php

namespace App\Providers;

use App\Helpers\ArtHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeAttributeForm();

        $this->composeAttributeValueForm();

        $this->composeCategoryForm();

        $this->composeProductForm();
		
		$this->composePageForm();
    }

    /**
     * compose partial view of attribute form
     */
    private function composeAttributeForm()
    {
        View::composer(

            'admin.attribute._form',

            function ($view) {
                $view->with('typeList', ArtHelper::attribute_types());
                $view->with('categories', ArtHelper::getCategoriesArr());
            }
        );
    }

    /**
     * compose partial view of attribute value form
     */
    private function composeAttributeValueForm()
    {
        View::composer(

            'admin.attribute-value._form',

            function ($view) {
                $view->with('attributeList', ArtHelper::attributes());
            }
        );
    }

    /**
     * compose partial view of category form
     */
    private function composeCategoryForm()
    {
        View::composer(

            'admin.category._form',

            function ($view) {
                $view->with('catList', ArtHelper::getCategoriesArr());
                $view->with('attrsList', ArtHelper::attributes(true));
            }
        );
    }
	
    /**
     * compose partial view of product form
     */
    private function composeProductForm()
    {
        View::composer(

            'admin.product._form',

            function ($view) {
                //$view->with('categories', ArtHelper::catWithSubGrpListArray());

                //$view->with('manufacturers', ArtHelper::manufacturers());

                //$view->with('gtin_types', ArtHelper::gtin_types());

                $view->with('countries', ArtHelper::countries());

                //$view->with('tags', ArtHelper::tags());
            }
        );
    }

    /**
     * compose page create form
     */
    private function composePageForm()
    {
        View::composer(

            'admin.page._form',

            function ($view) {
                $view->with([
                    'positions' => ArtHelper::page_positions(),
                ]);
            }
        );
    }
}
