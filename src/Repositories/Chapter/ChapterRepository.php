<?php

namespace Viviniko\Book\Repositories\Chapter;

interface ChapterRepository
{
    /**
     * Paginate books.
     *
     * @param $pageSize
     * @param string $searchName
     * @param null $search
     * @return mixed
     */
    public function paginate($pageSize, $searchName = 'search', $search = null);

    /**
     * @param $bookId
     * @param null $type
     * @param null $status
     * @return mixed
     */
    public function getChaptersByBookId($bookId, $type = null, $status = null);

    /**
     * Find data by id
     *
     * @param       $id
     * @param       $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);

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

    public function countWordsByBookId($bookId);

    public function getLatestChapterByBookId($bookId);

    public function getMaxNumberByBookId($bookId);

    public function countChapterByBookId($bookId);

    public function getChaptersTreeByBookId($bookId, $parentId = 0);
}