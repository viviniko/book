<?php

namespace Viviniko\Book\Repositories\Content;

use Viviniko\Repository\SimpleRepository;

class EloquentContent extends SimpleRepository implements ContentRepository
{
    protected $modelConfigKey = 'book.content';

}