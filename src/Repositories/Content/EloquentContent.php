<?php

namespace Viviniko\Book\Repositories\Content;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentContent extends EloquentRepository implements ContentRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.content'));
    }

}