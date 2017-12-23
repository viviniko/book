<?php

namespace Viviniko\Book\Repositories\Book;

use Viviniko\Repository\SimpleRepository;

class EloquentBook extends SimpleRepository implements BookRepository
{
    protected $modelConfigKey = 'book.book';

}