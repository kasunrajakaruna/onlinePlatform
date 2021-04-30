<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Reply\IReplyRepository;
use App\Repositories\Ticket\ITicketRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Reply\ReplyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ITicketRepository::class, TicketRepository::class);
        $this->app->bind(IReplyRepository::class, ReplyRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
