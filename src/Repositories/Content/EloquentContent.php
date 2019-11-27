<?php

namespace Viviniko\Book\Repositories\Content;

use Viviniko\Repository\EloquentRepository;

class EloquentContent extends EloquentRepository implements ContentRepository
{
    protected $modelConfigKey = 'book.content';

}