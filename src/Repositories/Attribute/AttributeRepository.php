<?php

namespace Viviniko\Book\Repositories\Attribute;

interface AttributeRepository
{
    /**
     * Paginate attributes.
     *
     * @param $groupId
     * @param $pageSize
     * @param string $searchName
     * @param null $search
     * @return mixed
     */
    public function paginate($groupId, $pageSize, $searchName = 'search', $search = null);

    /**
     * Get filterable attributes
     *
     * @param mixed $id
     * @return mixed
     */
    public function getFilterableAttributes($id);

    /**
     * Find data by id
     *
     * @param       $id
     * @param       $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    public function findInWithGroup($ids);

    /**
     * Save a new entity in repository
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update a entity in repository by id
     *
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);
}