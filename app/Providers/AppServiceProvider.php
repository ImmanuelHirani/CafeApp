<?php

namespace App\Providers;

use App\Models\orderTransaction;
use App\Models\tempTransaction;
use App\Models\tempTransactionDetails;
use App\Models\transaction;
use App\Models\transactionDetails;
use Illuminate\Support\ServiceProvider;
use App\Services\CustomerService;
use App\Repository\CustomerRepo;
use App\Repository\MenuRepo;
use Illuminate\Support\Facades\DB;
use App\Repository\orderRepo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Repository\RepositoryImpl\CustomerRepoImpl;
use App\Repository\RepositoryImpl\MenuRepoImpl;
use App\Repository\RepositoryImpl\OrderRepoImpl;
use App\Services\MenuService;
use App\Services\OrderService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding repository
        $this->app->bind(CustomerRepo::class, CustomerRepoImpl::class);
        $this->app->bind(MenuRepo::class, MenuRepoImpl::class);
        $this->app->bind(orderRepo::class, OrderRepoImpl::class);

        $this->app->bind(MenuService::class, function ($app) {
            return new MenuService($app->make(MenuRepo::class));
        });

        $this->app->singleton(CustomerService::class, function ($app) {
            return new CustomerService($app->make(CustomerRepo::class));
        });

        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService($app->make(orderRepo::class));
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Pastikan user sudah login
            $customerID = Auth::check() ? Auth::user()->customer_ID : null;

            // Jika user tidak login, tidak ada data cart
            $cartItems = $customerID
                ? transaction::where('customer_ID', $customerID)
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
