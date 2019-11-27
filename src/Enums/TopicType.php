<?php

namespace Viviniko\Book\Enums;

class TopicType
{
    const CHAPTER = 0;

    const VOLUME = 2;

    public static function values()
    {
        return [
            static::CHAPTER => trans('book.chapter'),
            static::VOLUME => trans('book.volume')
        ];
    }
}