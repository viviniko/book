<?php

namespace Viviniko\Book\Console\Commands;

use Viviniko\Support\Console\CreateMigrationCommand;

class BookTableCommand extends CreateMigrationCommand
{
    /**
     * @var string
     */
    protected $name = 'book:table';

    /**
     * @var string
     */
    protected $description = 'Create a migration for the book service table';

    /**
     * @var string
     */
    protected $stub = __DIR__.'/stubs/book.stub';

    /**
     * @var string
     */
    protected $migration = 'create_book_table';
}
