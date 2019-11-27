<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Topic extends Model
{
    protected $tableConfigKey = 'book.topics_table';

    protected $fillable = [
        'book_id', 'parent_id', 'path', 'title', 'description', 'status', 'word_count', 'number', 'position',
    ];

    public function book()
    {
        return $this->belongsTo(Config::get('book.book'));
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function content()
    {
        return $this->hasOne(Config::get('book.content'));
    }

    public function getDataAttribute()
    {
        return data_get($this->content, 'data');
    }
}