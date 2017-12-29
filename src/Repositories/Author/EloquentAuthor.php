<?php

namespace Viviniko\Book\Repositories\Author;

use Viviniko\Repository\SimpleRepository;

class EloquentAuthor extends SimpleRepository implements AuthorRepository
{
    protected $modelConfigKey = 'book.author';

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