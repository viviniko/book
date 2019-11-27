<?php

namespace Viviniko\Book\Repositories\Topic;

use Illuminate\Support\Collection;
use Viviniko\Book\Enums\TopicStatus;
use Viviniko\Book\Enums\TopicType;
use Viviniko\Repository\EloquentRepository;

class EloquentTopic extends EloquentRepository implements TopicRepository
{
    protected $modelConfigKey = 'book.topic';
}