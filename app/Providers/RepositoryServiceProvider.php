<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Review\ReviewContract;
use App\Repositories\Review\ReviewRepository;
use App\Contracts\Review\UserContract;
use App\Repositories\Review\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        ReviewContract::class        =>  ReviewRepository::class,
        UserContract::class          =>  UserRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
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
