<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        // Share categories with all views for the menu
        // In a real app, use a View Composer to limit this to specific views or cache it.
        // For simplicity/demo:
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                 $globalCategories = \Modules\Category\App\Models\Category::defaultOrder()->get()->toTree();
                 \Illuminate\Support\Facades\View::share('globalCategories', $globalCategories);
            }
        } catch (\Exception $e) {
            // Ignore if DB not ready
        }
    }
}
