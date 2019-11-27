<?php

namespace Viviniko\Book\Enums;

class TopicStatus
{
    const DRAFT = 0;

    const PUBLISHED = 1;

    public static function values()
    {
        return [
            static::DRAFT => 'Draft',
            static::PUBLISHED => 'Published',
        ];
    }
}