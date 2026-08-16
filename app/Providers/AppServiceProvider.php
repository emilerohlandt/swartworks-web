<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\MaterialCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        // Pass $materialsMap directly to the quoteformmodal component
        View::composer('components.quoteformmodal', function ($view) {
            $categories = MaterialCategory::with('materials')->get();

            $materialsMap = $categories->mapWithKeys(function ($category) {
                return [
                    $category->name => $category->materials->mapWithKeys(function ($material) {
                        return [$material->name => $material->colors ?? []];
                    })->toArray()
                ];
            });

            $view->with('materialsMap', $materialsMap);
        });
    }
}
