<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;

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
        //
        Paginator::useBootstrap();

        View::composer(['components.partials.header', '*'], function ($view) {
            if(auth()->check()) {
                $cart = Cart::with(['items.book_copy.book.author'])
                    ->where('user_id', auth()->id())
                    ->where('status', 'onActive')
                    ->first();

                $view->with('cart', $cart);
            } else {
                $view->with('cart', null);
            }
        });
    }
}
