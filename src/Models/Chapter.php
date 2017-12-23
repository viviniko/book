<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $tableConfigKey = 'book.chapters_table';

    protected $fillable = [
        'number', 'book_id', 'title'
    ];

    public function book()
    {
        return $this->belongsTo(Config::get('book.book'));
    }
}