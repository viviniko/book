<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $tableConfigKey = 'book.chapters_table';

    protected $fillable = [
        'number', 'book_id', 'title', 'description', 'status', 'word_count', 'parent_id', 'type'
    ];

    public function book()
    {
        return $this->belongsTo(Config::get('book.book'));
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