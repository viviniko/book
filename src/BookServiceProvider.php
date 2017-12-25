<?php

namespace Viviniko\Book;

use Viviniko\Book\Console\Commands\BookTableCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Viviniko\Book\Models\Category;
use Viviniko\Book\Models\Chapter;
use Viviniko\Book\Models\Content;
use Viviniko\Book\Observers\CategoryObserver;
use Viviniko\Book\Observers\ChapterObserver;
use Viviniko\Book\Observers\ContentObserver;

class BookServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        Chapter::observe(ChapterObserver::class);
        Content::observe(ContentObserver::class);

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

        $this->registerBookService();

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
            \Viviniko\Book\Repositories\Attribute\AttributeRepository::class,
            \Viviniko\Book\Repositories\Attribute\EloquentAttribute::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\AttributeGroup\AttributeGroupRepository::class,
            \Viviniko\Book\Repositories\AttributeGroup\EloquentAttributeGroup::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Book\BookRepository::class,
            \Viviniko\Book\Repositories\Book\EloquentBook::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Category\CategoryRepository::class,
            \Viviniko\Book\Repositories\Category\EloquentCategory::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Chapter\ChapterRepository::class,
            \Viviniko\Book\Repositories\Chapter\EloquentChapter::class
        );

        $this->app->singleton(
            \Viviniko\Book\Repositories\Content\ContentRepository::class,
            \Viviniko\Book\Repositories\Content\EloquentContent::class
        );
    }

    protected function registerBookService()
    {
        $this->app->singleton(
            \Viviniko\Book\Contracts\BookService::class,
            \Viviniko\Book\Services\BookServiceImpl::class
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
            \Viviniko\Book\Contracts\BookService::class,
            \Viviniko\Book\Repositories\Attribute\AttributeRepository::class,
            \Viviniko\Book\Repositories\AttributeGroup\AttributeGroupRepository::class,
            \Viviniko\Book\Repositories\Book\BookRepository::class,
            \Viviniko\Book\Repositories\Category\CategoryRepository::class,
            \Viviniko\Book\Repositories\Chapter\ChapterRepository::class,
            \Viviniko\Book\Repositories\Content\ContentRepository::class,
        ];
    }
}