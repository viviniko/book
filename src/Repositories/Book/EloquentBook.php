<?php

namespace Viviniko\Book\Repositories\Book;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentBook extends EloquentRepository implements BookRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.book'));
    }
}