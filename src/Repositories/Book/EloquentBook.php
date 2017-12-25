<?php

namespace Viviniko\Book\Repositories\Book;

use Viviniko\Repository\SimpleRepository;

class EloquentBook extends SimpleRepository implements BookRepository
{
    protected $modelConfigKey = 'book.book';

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
}