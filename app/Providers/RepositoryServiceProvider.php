<?php

namespace App\Providers;

use App\Models\Word;
use App\Repositories\WordRepository;
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
        $this->app->singleton(WordRepository::class, function() {
            return new WordRepository(new Word);
        });
    }
}
