<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Domains\Admin\Repositories\AdminRepository;
use Domains\Admin\Repositories\AdminRepositoryEloquent;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        App::bind(AdminRepository::class, AdminRepositoryEloquent::class);
    }

}
