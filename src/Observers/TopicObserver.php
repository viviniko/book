<?php

namespace Viviniko\Book\Observers;

use Viviniko\Book\Models\Topic;
use Viviniko\Book\Repositories\Book\BookRepository;
use Viviniko\Book\Repositories\Topic\TopicRepository;
use Viviniko\Book\Repositories\Content\ContentRepository;

class TopicObserver
{
    protected $books;

    protected $topics;

    protected $contents;

    public function __construct(BookRepository $books, TopicRepository $topics, ContentRepository $contents)
    {
        $this->books = $books;
        $this->topics = $topics;
        $this->contents = $contents;
    }

    public function saved(Topic $topic)
    {
        $path = $topic->parent ? $topic->parent->path : '';
        $path = trim($path . '/' . $topic->id, '/');
        if ($topic->path != $path) {
            $this->topics->update($topic->id, ['path' => $path]);
        }
    }

    public function deleted(Topic $chapter)
    {
        $this->contents->delete($chapter->id);
    }
}