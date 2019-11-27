<?php

namespace Viviniko\Book\Repositories\Attr;

use Viviniko\Repository\EloquentRepository;

class EloquentAttr extends EloquentRepository implements AttrRepository
{
    protected $modelConfigKey = 'book.attr';

    /**
     * {@inheritdoc}
     */
    public function listWithAttributes()
    {
        return $this->createModel()->newQuery()->with(['attributes'])->get();
    }
}