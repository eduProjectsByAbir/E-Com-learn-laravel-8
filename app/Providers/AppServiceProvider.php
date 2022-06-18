<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::with('subcategories', 'subcategories.subSubcategories')->latest('id')->get();
        view()->share('categories', $categories);

        $featuredproducts = Product::where('status', 1)->where('featured', 1)->latest('id')->limit(6)->get();
        view()->share('featuredproducts', $featuredproducts);

        $hotproducts = Product::where('status', 1)->where('hot_deals', 1)->latest('id')->limit(6)->get();
        view()->share('hotproducts', $hotproducts);

        $tags = Product::groupBy('tags')->pluck('tags')->implode(', ');
        $tags = (array_map('trim', array_unique(explode(',', $tags))));
        view()->share('tags', $tags);
    }
}
