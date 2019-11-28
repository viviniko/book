<?php

namespace Viviniko\Book\Observers;

use Illuminate\Support\Str;
use Viviniko\Book\Models\Content;
use Viviniko\Book\Repositories\Topic\TopicRepository;

class ContentObserver
{
    protected $topics;

    public function __construct(TopicRepository $topics)
    {
        $this->topics = $topics;
    }

    public function saved(Content $content)
    {
        $this->topics->update($content->topic_id, ['word_count' => Str::length($content->data)]);
    }
}