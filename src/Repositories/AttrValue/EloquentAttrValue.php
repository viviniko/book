<?php

namespace Viviniko\Book\Repositories\AttrValue;

use Viviniko\Repository\EloquentRepository;

class EloquentAttrValue extends EloquentRepository implements AttrValueRepository
{
    protected $modelConfigKey = 'book.attr_value';
}