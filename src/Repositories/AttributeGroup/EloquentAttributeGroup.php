<?php

namespace Viviniko\Book\Repositories\AttributeGroup;

use Viviniko\Repository\SimpleRepository;

class EloquentAttributeGroup extends SimpleRepository implements AttributeGroupRepository
{
    protected $modelConfigKey = 'book.attribute_group';

    /**
     * {@inheritdoc}
     */
    public function paginate($pageSize, $searchName = 'search', $search = null)
    {
        if (!$search) {
            $search = request()->get($searchName);
        }
        $search = is_array($search) ? $search : [];
        $items = $this->search($search)->paginate($pageSize);
        if (!empty($search)) {
            $items->appends([$searchName => $search]);
        }

        return $items;
    }

    /**
     * {@inheritdoc}
     */
    public function listWithAttributes()
    {
        return $this->createModel()->newQuery()->with(['attributes'])->get();
    }
}