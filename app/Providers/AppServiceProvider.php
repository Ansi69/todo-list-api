<?php

namespace App\Providers;

use App\Repositories\Abstracts\NoteRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\NoteRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\Abstracts\MailServiceInterface;
use App\Services\Abstracts\UserServiceInterface;
use App\Services\MailService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(NoteRepository::class, NoteRepositoryEloquent::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
