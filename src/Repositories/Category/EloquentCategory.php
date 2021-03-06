<?php

namespace Viviniko\Book\Repositories\Category;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentCategory extends EloquentRepository implements CategoryRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.category'));
    }
}