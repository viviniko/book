<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $tableConfigKey = 'book.chapters_table';

    protected $fillable = [
        'book_id', 'parent_id', 'path', 'title', 'description', 'status', 'word_count', 'number'
    ];

    public function book()
    {
        return $this->belongsTo(Config::get('book.book'));
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function chapterContent()
    {
        return $this->hasOne(Config::get('book.content'));
    }

    public function getContentAttribute()
    {
        return data_get($this->chapterContent, 'content');
    }
}