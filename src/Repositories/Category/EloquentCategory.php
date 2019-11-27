<?php

namespace Viviniko\Book\Repositories\Category;

use Viviniko\Repository\EloquentRepository;

class EloquentCategory extends EloquentRepository implements CategoryRepository
{
    protected $modelConfigKey = 'book.category';
}