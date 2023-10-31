<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Throwable;
use App\Helpers\ArtHelper;
use Illuminate\Support\Facades\View;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
	
	public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException || $exception instanceof  ModelNotFoundException) {
			
			if ($this->isHttpException($exception)) {

				View::share('pageclass', 'innerpage');
				View::share('pages', ArtHelper::pages(\App\Models\Page::VISIBILITY_PUBLIC));
				View::share('all_categories', ArtHelper::getCategories());
				View::share('recently_viewed_items', ArtHelper::recentlyViewedItems());
				View::share('footer_countries',  ArtHelper::getCountries());
				View::share('footer_units',  ArtHelper::getUnits());
				View::share('footer_languages',  ArtHelper::getLanguages());
				View::share('footer_currencies',  ArtHelper::getCurrencies());
				
				$statusCode = $exception->getStatusCode();
				switch ($statusCode) {
					case '404':
						return response()->view('errors/404');
					case '500';
						return response()->view('errors/500');
				}
			}
		}
		return parent::render($request, $exception);
	}

}
