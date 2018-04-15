<?php

namespace Viviniko\Book\Repositories\AttributeGroup;

use Viviniko\Repository\SimpleRepository;

class EloquentAttributeGroup extends SimpleRepository implements AttributeGroupRepository
{
    protected $modelConfigKey = 'book.attribute_group';

    /**
     * {@inheritdoc}
     */
    public function listWithAttributes()
    {
        return $this->createModel()->newQuery()->with(['attributes'])->get();
    }
}