<?php

namespace Viviniko\Book;

use Viviniko\Book\Console\Commands\BookTableCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Viviniko\Book\Models\Attr;
use Viviniko\Book\Models\Category;
use Viviniko\Book\Models\Topic;
use Viviniko\Book\Models\Content;
use Viviniko\Book\Observers\AttrObserver;
use Viviniko\Book\Observers\CategoryObserver;
use Viviniko\Book\Observers\TopicObserver;
use Viviniko\Book\Observers\ContentObserver;

class BookServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/book.php' => config_path('book.php'),
        ]);

        Category::observe(CategoryObserver::class);
        Topic::observe(TopicObserver::class);
        Content::observe(ContentObserver::class);
        Attr::observe(AttrObserver::class);

        // Register commands
        $this->commands('command.book.table');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/book.php', 'book');

        $this->registerRepositories();

        $this->registerCommands();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.book.table', function ($app) {
            return new BookTableCommand($app['files'], $app['composer']);
        });
    }

    protected function registerRepositories()
    {
        $this->app->singleton(
            \Viviniko\Book\Repositories\AttrValue\AttrValueRepository::class,
            \Viviniko\Book\Repositories\AttrValue\EloquentAttrValue::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Attr\AttrRepository::class,
            \Viviniko\Book\Repositories\Attr\EloquentAttr::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Author\AuthorRepository::class,
            \Viviniko\Book\Repositories\Author\EloquentAuthor::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Category\CategoryRepository::class,
            \Viviniko\Book\Repositories\Category\EloquentCategory::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Topic\TopicRepository::class,
            \Viviniko\Book\Repositories\Topic\EloquentTopic::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Content\ContentRepository::class,
            \Viviniko\Book\Repositories\Content\EloquentContent::class
        );
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
        ];
    }
}