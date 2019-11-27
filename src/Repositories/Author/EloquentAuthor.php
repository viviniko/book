<?php

namespace Viviniko\Book\Repositories\Author;

use Viviniko\Repository\EloquentRepository;

class EloquentAuthor extends EloquentRepository implements AuthorRepository
{
    protected $modelConfigKey = 'book.author';
}