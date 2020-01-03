<?php

namespace App\Providers;

use App\Repositories\Contracts\QuizRepositoryInterface;
use App\Repositories\OtpRepository;
use App\Repositories\OtpRepositoryInterface;
use App\Repositories\QuizRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(OtpRepositoryInterface::class, OtpRepository::class);
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(QuizRepositoryInterface::class, QuizRepository::class);
    }
}
