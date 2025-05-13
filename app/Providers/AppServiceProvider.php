<?php

namespace App\Providers;


use App\Models\transaction;
use Illuminate\Support\ServiceProvider;
use App\Services\userService;
use App\Repository\userRepo;
use App\Repository\MenuRepo;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Repository\RepositoryImpl\userRepoImpl;
use App\Repository\RepositoryImpl\MenuRepoImpl;

use App\Services\MenuService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding repository
        $this->app->bind(userRepo::class, userRepoImpl::class);
        $this->app->bind(MenuRepo::class, MenuRepoImpl::class);


        $this->app->bind(MenuService::class, function ($app) {
            return new MenuService($app->make(MenuRepo::class));
        });

        $this->app->singleton(userService::class, function ($app) {
            return new userService($app->make(userRepo::class));
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Pastikan user sudah login
            $userID = Auth::check() ? Auth::user()->user_ID : null;

            // Jika user tidak login, tidak ada data cart
            $cartItems = $userID
                ? transaction::where('user_ID', $userID)
                ->where('status_order', 'pending')
                ->with(['details.menu']) // Eager load order_details untuk akses order_type
                ->get()
                ->flatMap(fn($transaction) => $transaction->details)
                : collect();

            // Data ini akan tersedia di semua view
            $view->with('cartItems', $cartItems);
        });

        // Logging query untuk debugging
        DB::listen(function ($query) {
            logger()->info('Query Executed: ', ['sql' => $query->sql, 'bindings' => $query->bindings, 'time' => $query->time]);
        });
    }
}
