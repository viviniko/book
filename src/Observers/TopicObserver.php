<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Enums\TopicStatus;
use Viviniko\Book\Models\Topic;
use Viviniko\Book\Repositories\Topic\TopicRepository;
use Viviniko\Book\Repositories\Content\ContentRepository;

class TopicObserver
{
    protected $topics;

    protected $contents;

    public function __construct(TopicRepository $topics, ContentRepository $contents)
    {
        $this->topics = $topics;
        $this->contents = $contents;
    }

    public function saved(Topic $topic)
    {
        if ($topic->parent_id) {
            $this->topics->update($topic->parent_id,
                ['word_count' => $this->topics->findAllBy(['parent_id' => $topic->parent_id, 'status' => TopicStatus::PUBLISHED])]);
        }
    }

    public function deleted(Topic $topic)
    {
        $this->contents->delete($topic->id);
    }
}