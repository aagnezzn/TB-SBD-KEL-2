<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

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
    // Kode ini akan mengirim data $navCategories ke SEMUA view secara otomatis
    View::composer('*', function ($view) {
        $navCategories = Category::whereNull('parent_id')
                            ->with('children.children')
                            ->get();
        $view->with('navCategories', $navCategories);
    });
}
}
