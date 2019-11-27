<?php

namespace Viviniko\Book\Repositories\Book;

use Viviniko\Repository\EloquentRepository;

class EloquentBook extends EloquentRepository implements BookRepository
{
    protected $modelConfigKey = 'book.book';
}