<?php

namespace Viviniko\Book\Repositories\Chapter;

use Viviniko\Repository\SimpleRepository;

class EloquentChapter extends SimpleRepository implements ChapterRepository
{
    protected $modelConfigKey = 'book.chapter';

}