<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\View;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;
use Cart;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
            AttributeContract::class        =>          AttributeRepository::class,
            BrandContract::class            =>          BrandRepository::class,
            ProductContract::class          =>          ProductRepository::class,
        OrderContract::class            =>          OrderRepository::class,
    ];
    public function register()
    {
        $this->app->bind(App\Contracts\OrderContract::class,App\Repositories\OrderRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
