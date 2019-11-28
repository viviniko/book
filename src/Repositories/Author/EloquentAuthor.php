<?php

namespace Viviniko\Book\Repositories\Author;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentAuthor extends EloquentRepository implements AuthorRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.author'));
    }
}