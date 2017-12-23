<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Content extends Model
{
    protected $tableConfigKey = 'book.contents_table';

    protected $fillable = [
        'book_id', 'chapter_id', 'content',
    ];

    public function chapter()
    {
        return $this->belongsTo(Config::get('book.chapter'));
    }

    public function book()
    {
        return $this->belongsTo(Config::get('book.book'));
    }
}