<?php

namespace Viviniko\Book\Repositories\Author;

use Viviniko\Repository\SimpleRepository;

class EloquentAuthor extends SimpleRepository implements AuthorRepository
{
    protected $modelConfigKey = 'book.author';
}