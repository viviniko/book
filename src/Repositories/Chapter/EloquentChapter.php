<?php

namespace Viviniko\Book\Repositories\Chapter;

use Viviniko\Book\Enums\ChapterStatus;
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

    /**
     * {@inheritdoc}
     */
    public function countWordsByBookId($bookId)
    {
        return $this->createModel()
            ->where(['book_id' => $bookId, 'status' => ChapterStatus::PUBLISHED])
            ->sum('word_count');
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestChapterByBookId($bookId)
    {
        return $this->createModel()
            ->where(['book_id' => $bookId, 'status' => ChapterStatus::PUBLISHED])
            ->orderBy('number', 'desc')
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function countChapterByBookId($bookId)
    {
        return $this->createModel()
            ->where(['book_id' => $bookId, 'status' => ChapterStatus::PUBLISHED])
            ->count();
    }
}