<?php

namespace App\Providers;

use App\Interfaces\CityInterface;
use App\Interfaces\ApiCityInterface;
use App\Repositories\CityRepository;
use App\Interfaces\ProvinceInterface;
use App\Repositories\ApiCityRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ApiProvinceInterface;
use App\Repositories\ProvinceRepository;
use App\Repositories\ApiProvinceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProvinceInterface::class, ProvinceRepository::class);
        $this->app->bind(ApiProvinceInterface::class, ApiProvinceRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
        $this->app->bind(ApiCityInterface::class, ApiCityRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
