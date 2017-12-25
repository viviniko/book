<?php

namespace Viviniko\Book\Observers;

use Illuminate\Support\Str;
use Viviniko\Book\Models\Content;
use Viviniko\Book\Repositories\Chapter\ChapterRepository;

class ContentObserver
{
    protected $chapters;

    public function __construct(ChapterRepository $chapters)
    {
        $this->chapters = $chapters;
    }

    public function saved(Content $content)
    {
        $this->chapters->update($content->chapter_id, ['word_count' => Str::length($content->content)]);
    }
}