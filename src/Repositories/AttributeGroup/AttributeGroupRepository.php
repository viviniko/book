<?php

namespace Viviniko\Book\Repositories\AttributeGroup;

interface AttributeGroupRepository
{
    /**
     * Paginate books.
     *
     * @param $pageSize
     * @param string $searchName
     * @param null $search
     * @param null $order
     * @return mixed
     */
    public function paginate($pageSize, $searchName = 'search', $search = null, $order = null);

    /**
     * @return mixed
     */
    public function listWithAttributes();

    /**
     * Find data by id
     *
     * @param       $id
     *
     * @return mixed
     */
    public function find($id);

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