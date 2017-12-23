<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Support\Database\Eloquent\Model;

class Book extends Model
{
    protected $tableConfigKey = 'book.books_table';

    protected $fillable = [
        'name', 'author', 'cover', 'description', 'latest_chapter', 'chapter_count', 'is_end',
        'word_count', 'category_id', 'is_active', 'url_rewrite'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_end' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Config::get('book.category'), 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany(Config::get('book.chapter'));
    }

    public function attributes()
    {
        return $this->belongsToMany(Config::get('book.attribute'), Config::get('book.book_attribute_table'));
    }
}