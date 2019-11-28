<?php

namespace Viviniko\Book\Models;

use Illuminate\Support\Facades\Config;
use Viviniko\Book\Enums\TopicStatus;
use Viviniko\Book\Enums\TopicType;
use Viviniko\Support\Database\Eloquent\Model;

class Book extends Model
{
    protected $tableConfigKey = 'book.books_table';

    protected $fillable = [
        'name', 'author_id', 'image_id', 'description', 'end', 'category_id', 'slug', 'status'
    ];

    protected $casts = [
        'is_end' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(Config::get('book.author'), 'author_id');
    }

    public function image()
    {
        return $this->belongsTo(Config::get('media.file'), 'image_id');
    }

    public function category()
    {
        return $this->belongsTo(Config::get('book.category'), 'category_id');
    }

    public function latestTopic()
    {
        return $this->topics()
            ->where(['status' => TopicStatus::PUBLISHED, 'type' => TopicType::CHAPTER])
            ->orderBy('position')
            ->first();
    }

    public function wordCount()
    {
        return $this->topics()->sum('word_count');
    }

    public function topics()
    {
        return $this->hasMany(Config::get('book.topic'));
    }
}