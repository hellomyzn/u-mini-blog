<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

# interface
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;

# repository
use App\Repositories\Blogs\BlogModelRepository;
use App\Repositories\Users\UserModelRepository;
use App\Repositories\Comments\CommentModelRepository;



class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogModelRepository::class);        
        $this->app->bind(UserRepositoryInterface::class, UserModelRepository::class);        
        $this->app->bind(CommentRepositoryInterface::class, CommentModelRepository::class);        
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
