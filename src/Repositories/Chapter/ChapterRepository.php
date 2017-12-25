<?php

namespace Viviniko\Book\Repositories\Chapter;

interface ChapterRepository
{
    /**
     * Paginate books.
     *
     * @param $bookId
     * @param $pageSize
     * @param string $searchName
     * @param null $search
     * @return mixed
     */
    public function paginate($bookId, $pageSize, $searchName = 'search', $search = null);
}