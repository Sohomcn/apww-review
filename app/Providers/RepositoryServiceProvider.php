<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Review\ReviewContract;
use App\Repositories\Review\ReviewRepository;
use App\Contracts\User\UserContract;
use App\Repositories\User\UserRepository;
use App\Contracts\Post\PostContract;
use App\Repositories\Post\PostRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        ReviewContract::class        =>  ReviewRepository::class,
        UserContract::class          =>  UserRepository::class,
        PostContract::class          =>  PostRepository::class,
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
