<?php

namespace Viviniko\Book\Enums;

class ChapterStatus
{
    const PUBLISHED = 'Published';

    const DRAFT = 'Draft';

    public static function values()
    {
        return [
            static::PUBLISHED => static::PUBLISHED,
            static::DRAFT => static::DRAFT,
        ];
    }
}