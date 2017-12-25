<?php

namespace Viviniko\Book\Repositories\Chapter;

use Viviniko\Repository\SimpleRepository;

class EloquentChapter extends SimpleRepository implements ChapterRepository
{
    protected $modelConfigKey = 'book.chapter';

    /**
     * {@inheritdoc}
     */
    public function paginate($bookId, $pageSize, $searchName = 'search', $search = null)
    {
        if (!$search) {
            $search = request()->get($searchName);
        }
        $search = is_array($search) ? $search : [];
        $items = $this->search(array_merge($search, ['book_id' => $bookId]))->paginate($pageSize);
        if (!empty($search)) {
            $items->appends([$searchName => $search]);
        }

        return $items;
    }
}