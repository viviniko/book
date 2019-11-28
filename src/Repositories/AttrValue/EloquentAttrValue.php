<?php

namespace Viviniko\Book\Repositories\AttrValue;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentAttrValue extends EloquentRepository implements AttrValueRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.attr_value'));
    }
}