<?php

namespace Viviniko\Book\Repositories\Topic;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentTopic extends EloquentRepository implements TopicRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('book.topic'));
    }
}