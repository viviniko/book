<?php

namespace Viviniko\Book\Repositories\Attribute;

use Viviniko\Repository\SimpleRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Config;

class EloquentAttribute extends SimpleRepository implements AttributeRepository
{
    protected $modelConfigKey = 'book.attribute';

    /**
     * {@inheritdoc}
     */
    public function getFilterableAttributes($id)
    {
        $specificationGroupTableName = Config::get('catalog.attribute_groups_table');
        $specificationTablesName = Config::get('catalog.attributes_table');
        return $this->createModel()->newQuery()->with('group')
            ->join($specificationGroupTableName, "{$specificationGroupTableName}.id", '=', "{$specificationTablesName}.group_id")
            ->where("{$specificationGroupTableName}.is_filterable", true)
            ->whereIn("{$specificationTablesName}.id", is_array($id) || $id instanceof Arrayable ? $id : [$id])
            ->get(["{$specificationTablesName}.*"]);
    }

    public function findInWithGroup($ids)
    {
        return $this->createModel()->newQuery()->whereIn('id', $ids)->with('group')->get();
    }
}