<?php

namespace Viviniko\Book\Repositories\Chapter;

use Illuminate\Support\Collection;
use Viviniko\Book\Enums\ChapterStatus;
use Viviniko\Book\Enums\ChapterType;
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

    public function getChaptersByBookId($bookId, $type = null, $status = null)
    {
        $where = [
            'book_id' => $bookId,
        ];
        if (!is_null($type)) {
            $where['type'] = $type;
        }
        if (!is_null($status)) {
            $where['status'] = $status;
        }

        return $this->createModel()->where($where)->get();
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
            ->where(['book_id' => $bookId, 'status' => ChapterStatus::PUBLISHED, 'type' => ChapterType::CHAPTER])
            ->orderBy('number', 'desc')
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function countChapterByBookId($bookId)
    {
        return $this->createModel()
            ->where(['book_id' => $bookId, 'status' => ChapterStatus::PUBLISHED, 'type' => ChapterType::CHAPTER])
            ->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxNumberByBookId($bookId)
    {
        return $this->createModel()
            ->where(['book_id' => $bookId])
            ->max('number');
    }

    public function getChaptersTreeByBookId($bookId, $parentId = 0)
    {
        $collection = $this->getChaptersByBookId($bookId);
        $parentKey = 'parent_id';
        $groupNodes = $collection->groupBy($parentKey);

        return $collection
            ->map(function($item) use ($groupNodes) {
                $item->text = $item->title;
                $item->setRelation('children', Collection::make($groupNodes->get($item->id, [])));
                return $item;
            })->filter(function($item) use ($parentId, $parentKey) {
                return $item->{$parentKey} == $parentId;
            })->values();
    }
}