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
    // Hanya kirim data ke file navbar dan footer, bukan ke SEMUA file.
    View::composer('*', function ($view) {
        $navCategories = Category::whereNull('parent_id')
                            ->with('children.children') 
                            ->get();
        $view->with('navCategories', $navCategories);
    });
  }
}
