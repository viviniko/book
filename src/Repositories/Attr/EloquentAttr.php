<?php

namespace Viviniko\Book\Repositories\Attr;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentAttr extends EloquentRepository implements AttrRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.attr'));
    }

    /**
     * {@inheritdoc}
     */
    public function listWithAttributes()
    {
        return $this->createModel()->newQuery()->with(['attributes'])->get();
    }
}